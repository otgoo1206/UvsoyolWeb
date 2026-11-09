import "./bootstrap";

// Copy-link share button (news article page)
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("[data-copy-link]").forEach((btn) => {
        btn.addEventListener("click", async () => {
            try {
                await navigator.clipboard.writeText(window.location.href);
                const original = btn.innerHTML;
                btn.innerHTML =
                    '<svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>';
                setTimeout(() => {
                    btn.innerHTML = original;
                }, 1500);
            } catch (e) {
                // Clipboard API unavailable — silently ignore.
            }
        });
    });
});

const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
const isFinePointer = window.matchMedia("(pointer: fine)").matches;

// Counter animation
document.addEventListener("DOMContentLoaded", function () {
    const counters = document.querySelectorAll(".counter");

    const observer = new IntersectionObserver(
        (entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = +counter.getAttribute("data-target");
                    const duration = 2000;
                    const start = 0;
                    let startTime = null;

                    const updateCounter = (currentTime) => {
                        if (!startTime) startTime = currentTime;
                        const elapsedTime = currentTime - startTime;
                        const progress = Math.min(elapsedTime / duration, 1);
                        counter.textContent =
                            Math.floor(progress * target) + "+";
                        if (progress < 1) {
                            requestAnimationFrame(updateCounter);
                        } else {
                            counter.textContent = target + "+";
                        }
                    };

                    requestAnimationFrame(updateCounter);
                    observer.unobserve(counter);
                }
            });
        },
        { threshold: 0.1 }
    );

    counters.forEach((counter) => observer.observe(counter));
});

// Generic scroll-reveal animation for elements with class="reveal" / "reveal-scale" / "reveal-left" / "reveal-right"
document.addEventListener("DOMContentLoaded", function () {
    // Elements inside a [data-stagger] container reveal one after another
    // instead of all at once.
    document.querySelectorAll("[data-stagger]").forEach((group) => {
        const step = Number(group.getAttribute("data-stagger")) || 90;
        const revealEls = group.querySelectorAll(".reveal, .reveal-scale, .reveal-left, .reveal-right");
        revealEls.forEach((el, i) => {
            el.style.transitionDelay = `${i * step}ms`;
        });
    });

    const revealTargets = document.querySelectorAll(".reveal, .reveal-scale, .reveal-left, .reveal-right");

    if (!revealTargets.length) return;

    if (prefersReducedMotion) {
        revealTargets.forEach((el) => {
            el.classList.add("is-visible");
            el.querySelectorAll("[data-fill]").forEach((bar) => {
                bar.classList.remove("scale-x-0");
                bar.classList.add("scale-x-100");
            });
        });
        return;
    }

    const revealObserver = new IntersectionObserver(
        (entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("is-visible");
                    entry.target.querySelectorAll("[data-fill]").forEach((bar) => {
                        bar.classList.remove("scale-x-0");
                        bar.classList.add("scale-x-100");
                    });
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.15 }
    );

    revealTargets.forEach((el) => revealObserver.observe(el));
});

// Product catalog category filter (pill buttons + category cards)
document.addEventListener("DOMContentLoaded", function () {
    const pills = document.querySelectorAll(".category-pill");
    const cards = document.querySelectorAll(".product-card");
    const grid = document.getElementById("product-grid");
    const emptyState = document.getElementById("product-empty");

    if (!pills.length || !cards.length) return;

    const applyFilter = (filter) => {
        let visibleCount = 0;

        cards.forEach((card) => {
            const matches = filter === "ALL" || card.getAttribute("data-category") === filter;
            card.classList.toggle("hidden", !matches);
            if (matches) visibleCount++;
        });

        if (emptyState) {
            emptyState.classList.toggle("hidden", visibleCount !== 0);
        }

        pills.forEach((pill) => {
            pill.classList.toggle("active", pill.getAttribute("data-filter") === filter);
        });
    };

    pills.forEach((pill) => {
        pill.addEventListener("click", () => {
            const filter = pill.getAttribute("data-filter");
            applyFilter(filter);
            if (grid) grid.scrollIntoView({ behavior: "smooth", block: "start" });
        });
    });

    // Pre-select a category when the page is opened with ?category=...
    const params = new URLSearchParams(window.location.search);
    const initialCategory = params.get("category");
    if (initialCategory) {
        applyFilter(initialCategory);
        if (grid) grid.scrollIntoView({ block: "start" });
    }
});

// Sticky nav: shrink + glass background once the page has scrolled
document.addEventListener("DOMContentLoaded", function () {
    const nav = document.querySelector(".site-nav");
    if (!nav) return;

    const applyState = () => {
        nav.classList.toggle("scrolled", window.scrollY > 40);
    };

    applyState();

    let ticking = false;
    window.addEventListener("scroll", () => {
        if (ticking) return;
        ticking = true;
        requestAnimationFrame(() => {
            applyState();
            ticking = false;
        });
    });
});

// Subtle scroll parallax for elements with class="parallax" (disabled on
// mobile and when the visitor prefers reduced motion — see spec: heavy
// parallax should never run on small screens).
document.addEventListener("DOMContentLoaded", function () {
    const parallaxEls = document.querySelectorAll(".parallax");
    if (!parallaxEls.length || prefersReducedMotion || window.innerWidth < 768) return;

    let ticking = false;
    const update = () => {
        parallaxEls.forEach((el) => {
            const speed = Number(el.getAttribute("data-parallax-speed")) || 0.15;
            const rect = el.getBoundingClientRect();
            const offset = (rect.top - window.innerHeight / 2) * speed;
            el.style.transform = `translate3d(0, ${offset}px, 0)`;
        });
        ticking = false;
    };

    window.addEventListener(
        "scroll",
        () => {
            if (ticking) return;
            ticking = true;
            requestAnimationFrame(update);
        },
        { passive: true }
    );
    update();
});

// Custom cursor (desktop with a precise pointer only)
document.addEventListener("DOMContentLoaded", function () {
    if (prefersReducedMotion || !isFinePointer) return;

    const dot = document.getElementById("cursor-dot");
    const ring = document.getElementById("cursor-ring");
    if (!dot || !ring) return;

    document.body.classList.add("has-custom-cursor");

    let ringX = window.innerWidth / 2;
    let ringY = window.innerHeight / 2;
    let targetX = ringX;
    let targetY = ringY;

    const loop = () => {
        ringX += (targetX - ringX) * 0.18;
        ringY += (targetY - ringY) * 0.18;
        ring.style.transform = `translate3d(${ringX}px, ${ringY}px, 0) translate(-50%, -50%)`;
        requestAnimationFrame(loop);
    };
    requestAnimationFrame(loop);

    window.addEventListener("mousemove", (e) => {
        targetX = e.clientX;
        targetY = e.clientY;
        dot.style.transform = `translate3d(${e.clientX}px, ${e.clientY}px, 0) translate(-50%, -50%)`;
    });

    document.addEventListener("mouseover", (e) => {
        if (e.target.closest("a, button, .cursor-hover")) {
            ring.classList.add("cursor-hover");
        }
    });
    document.addEventListener("mouseout", (e) => {
        if (e.target.closest("a, button, .cursor-hover")) {
            ring.classList.remove("cursor-hover");
        }
    });
});

// Form submission
const scriptURL =
    "https://script.google.com/macros/s/AKfycbwK8LUEaY_UUePFS483b-4sGNcE2T8PUdb4EItAl2OGc1xq_fu0cvA486LB-E70AMGwkg/exec";
const forms = document.querySelectorAll('form[name="submit-to-google-sheet"]');

forms.forEach((form) => {
    const submitButton = form.querySelector('button[type="submit"]');
    const alertBox = document.createElement("div");
    alertBox.style.position = "relative";
    alertBox.style.left = "50%";
    alertBox.style.transform = "translateX(-50%)";
    alertBox.style.bottom = "-1em";
    alertBox.style.marginTop = "";
    alertBox.style.width = "100%";
    alertBox.style.textAlign = "start";
    alertBox.style.zIndex = "10";

    form.style.position = "relative";
    form.style.paddingBottom = "1em";

    form.addEventListener("submit", (e) => {
        e.preventDefault();

        submitButton.innerHTML = `
        <div role="status" class="flex items-center space-x-2">
            <div>
                <svg aria-hidden="true" class="inline w-4 h-4 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
            </div>
            <div>Loading</div>
            <span class="sr-only">Loading...</span>
        </div>`;

        submitButton.disabled = true;
        submitButton.classList.add("cursor-not-allowed");

        // Google Apps Script web apps don't send an Access-Control-Allow-Origin
        // header, so a normal "cors" fetch is blocked by the browser before the
        // .then() below ever runs (the request still reaches Google's servers,
        // but the response can't be read). "no-cors" sends the request without
        // that check, at the cost of an opaque, unreadable response.
        fetch(scriptURL, { method: "POST", mode: "no-cors", body: new FormData(form) })
            .then(() => {
                alertBox.innerHTML =
                    '<div class="p-4 text-sm text-green-700 bg-green-100 rounded-lg flex items-center space-x-2" role="alert"><div><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16"><path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/></svg></div><div>Message sent successfully!<div></div>';
                form.appendChild(alertBox);

                const nama = form.querySelector('input[name="nama"]').value;
                const judul = form.querySelector('input[name="judul"]').value;
                const pesan = form.querySelector('input[name="pesan"]').value;
                const whatsappNumber = form.dataset.whatsapp;

                if (whatsappNumber) {
                    const whatsappMessage = `Hello Admin, my name is ${nama}\nTopic I would like to discuss: ${judul}\nMessage: ${pesan}`;
                    const whatsappURL = `https://api.whatsapp.com/send?phone=${whatsappNumber}&text=${encodeURIComponent(
                        whatsappMessage
                    )}`;
                    window.location.href = whatsappURL;
                }

                form.reset();

                submitButton.innerHTML = "Send Message";
                submitButton.disabled = false;
                submitButton.classList.remove("cursor-not-allowed");
            })
            .catch((error) => {
                alertBox.innerHTML =
                    '<div class="p-4 text-sm text-red-700 bg-red-100 rounded-lg flex items-center space-x-2" role="alert"><div><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16"><path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/></svg></div><div>Failed to send message!<div></div>';
                form.appendChild(alertBox);

                submitButton.innerHTML = "Send Message";
                submitButton.disabled = false;
                submitButton.classList.remove("cursor-not-allowed");

                console.error("Error!", error.message);
            });
    });
});

// Footer newsletter signup — a separate, minimal handler because this form
// only collects an email address (no nama/judul/pesan fields, no WhatsApp
// redirect), unlike the contact-page message form above.
document.addEventListener("DOMContentLoaded", function () {
    const newsletterForms = document.querySelectorAll('form[name="newsletter-signup"]');

    newsletterForms.forEach((form) => {
        const submitButton = form.querySelector('button[type="submit"]');
        const successMessage = form.querySelector("#success-message");
        const originalButtonText = submitButton.innerHTML;

        form.addEventListener("submit", (e) => {
            e.preventDefault();

            submitButton.disabled = true;
            submitButton.classList.add("cursor-not-allowed");

            fetch(scriptURL, { method: "POST", mode: "no-cors", body: new FormData(form) })
                .then(() => {
                    form.reset();
                    if (successMessage) {
                        successMessage.classList.remove("hidden");
                        successMessage.classList.add("flex");
                    }
                })
                .catch((error) => {
                    console.error("Newsletter signup error!", error.message);
                })
                .finally(() => {
                    submitButton.innerHTML = originalButtonText;
                    submitButton.disabled = false;
                    submitButton.classList.remove("cursor-not-allowed");
                });
        });
    });
});

// Media video modal (homepage "Медиа" section)
document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("media-modal");
    if (!modal) return;

    const modalVideo = document.getElementById("media-modal-video");
    const closeBtn = document.getElementById("media-modal-close");

    const open = (src) => {
        modalVideo.src = src;
        modal.classList.remove("hidden");
        modal.classList.add("flex");
        modalVideo.play().catch(() => {});
    };

    const close = () => {
        modalVideo.pause();
        modalVideo.src = "";
        modal.classList.add("hidden");
        modal.classList.remove("flex");
    };

    document.querySelectorAll(".media-item").forEach((item) => {
        item.addEventListener("click", () => {
            const src = item.getAttribute("data-video");
            if (src) open(src);
        });
    });

    closeBtn.addEventListener("click", close);
    modal.addEventListener("click", (e) => {
        if (e.target === modal) close();
    });
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") close();
    });
});

// Nav search toggle
document.addEventListener("DOMContentLoaded", function () {
    const toggle = document.getElementById("nav-search-toggle");
    const form = document.getElementById("nav-search-form");
    if (!toggle || !form) return;

    toggle.addEventListener("click", (e) => {
        e.stopPropagation();
        form.classList.toggle("hidden");
        if (!form.classList.contains("hidden")) {
            form.querySelector("input")?.focus();
        }
    });

    document.addEventListener("click", (e) => {
        if (!form.contains(e.target) && e.target !== toggle) {
            form.classList.add("hidden");
        }
    });
});

// Generic horizontal carousel: any element with [data-carousel] wraps a
// .carousel-track plus optional [data-carousel-prev], [data-carousel-next]
// buttons and a [data-carousel-dots] container. Used for the products and
// news homepage carousels.
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("[data-carousel]").forEach((root) => {
        const track = root.querySelector(".carousel-track");
        if (!track) return;

        // Prev/next buttons commonly live in a heading row above the
        // [data-carousel] wrapper rather than inside it, so look in the
        // shared parent container too.
        const scope = root.parentElement || root;
        const prevBtn = scope.querySelector("[data-carousel-prev]");
        const nextBtn = scope.querySelector("[data-carousel-next]");
        const dotsWrap = root.querySelector("[data-carousel-dots]");
        const cards = Array.from(track.children);
        if (!cards.length) return;

        // Build one dot per card
        let dots = [];
        if (dotsWrap) {
            dotsWrap.innerHTML = "";
            dots = cards.map((_, i) => {
                const dot = document.createElement("button");
                dot.type = "button";
                dot.className = "carousel-dot";
                dot.setAttribute("aria-label", `Slide ${i + 1}`);
                dot.addEventListener("click", () => {
                    cards[i].scrollIntoView({ behavior: "smooth", inline: "start", block: "nearest" });
                });
                dotsWrap.appendChild(dot);
                return dot;
            });
        }

        const setActiveDot = () => {
            if (!dots.length) return;
            const trackLeft = track.scrollLeft;
            let closest = 0;
            let closestDist = Infinity;
            cards.forEach((card, i) => {
                const dist = Math.abs(card.offsetLeft - track.offsetLeft - trackLeft);
                if (dist < closestDist) {
                    closestDist = dist;
                    closest = i;
                }
            });
            dots.forEach((d, i) => d.classList.toggle("active", i === closest));
        };

        let ticking = false;
        track.addEventListener("scroll", () => {
            if (ticking) return;
            ticking = true;
            requestAnimationFrame(() => {
                setActiveDot();
                ticking = false;
            });
        });

        const scrollByCard = (dir) => {
            const card = cards[0];
            const gap = parseFloat(getComputedStyle(track).columnGap || "24");
            const amount = (card.getBoundingClientRect().width + gap) * dir;
            track.scrollBy({ left: amount, behavior: "smooth" });
        };

        prevBtn?.addEventListener("click", () => scrollByCard(-1));
        nextBtn?.addEventListener("click", () => scrollByCard(1));

        setActiveDot();
    });
});
