<!DOCTYPE html>
<html class="light" lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Strategic Delivery Thinking Professional | Agile fun!</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&amp;family=Lora:ital,wght@0,400;0,700;1,400&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#FFD500",
                        "background-light": "#FFFFFF",
                        "background-dark": "#000000",
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"],
                        "serif": ["Lora", "serif"]
                    },
                },
            },
        }
    </script>
    <style type="text/tailwindcss">
        :root {
        --primary-color: #FFD500;
    }

    /* Fuentes globales */
    body {
        font-family: 'Manrope', sans-serif;
    }
    .serif-title {
        font-family: 'Lora', serif;
    }

    /* Header */
    .sticky-header {
        position: sticky;
        top: 0;
        z-index: 50;
    }

    /* Listas con chevron */
    .yellow-chevron-list li {
        position: relative;
        padding-left: 2rem;
        margin-bottom: 0.75rem;
    }
    .yellow-chevron-list li::before {
        content: 'chevron_right';
        font-family: 'Material Symbols Outlined';
        position: absolute;
        left: 0;
        color: var(--primary-color);
        font-weight: bold;
    }

    /* Acordeones */
    .accordion-item[open] .summary-icon {
        transform: rotate(180deg);
    }
</style>
</head>

<body class="bg-background-light text-black font-display">
    <?php require 'db.php'; ?>
    <div class="bg-primary py-2.5 px-6">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-center gap-4 text-sm">
            <p class="font-bold flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">calendar_month</span>
                <?php echo htmlspecialchars(get_content('banner', 'text')); ?>
            </p>
            <button
                class="bg-black text-white px-4 py-1 rounded-full text-xs font-black uppercase tracking-wider hover:bg-zinc-800 transition-colors">
                <?php echo htmlspecialchars(get_content('banner', 'button_text')); ?>
            </button>
        </div>
    </div>
    <header class="sticky-header border-b border-slate-200 bg-white/95 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="text-primary">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M13.8261 17.4264C16.7203 18.1174 20.2244 18.5217 24 18.5217C27.7756 18.5217 31.2797 18.1174 34.1739 17.4264C36.9144 16.7722 39.9967 15.2331 41.3563 14.1648L24.8486 40.6391C24.4571 41.267 23.5429 41.267 23.1514 40.6391L6.64374 14.1648C8.00331 15.2331 11.0856 16.7722 13.8261 17.4264Z"
                            fill="currentColor"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-extrabold tracking-tight"><?php echo htmlspecialchars(get_content('header', 'logo_alt')); ?></h2>
            </div>
            <nav class="hidden md:flex items-center gap-8">
                <a class="text-sm font-semibold hover:text-primary transition-colors" href="#why"><?php echo htmlspecialchars(get_content('header', 'nav_why')); ?></a>
                <a class="text-sm font-semibold hover:text-primary transition-colors" href="#program"><?php echo htmlspecialchars(get_content('header', 'nav_program')); ?></a>
                <a class="text-sm font-semibold hover:text-primary transition-colors" href="#instructor"><?php echo htmlspecialchars(get_content('header', 'nav_instructor')); ?></a>
                <a class="text-sm font-semibold hover:text-primary transition-colors" href="#whom"><?php echo htmlspecialchars(get_content('header', 'nav_whom')); ?></a>
            </nav>
            <button
                class="bg-primary text-black px-6 py-2.5 rounded-lg font-bold text-sm tracking-wide hover:brightness-95 transition-all shadow-sm">
                <?php echo htmlspecialchars(get_content('header', 'cta_text')); ?>
            </button>
        </div>
    </header>
    <section class="bg-black text-white relative overflow-hidden">
        <div
            class="max-w-7xl mx-auto px-6 py-20 md:py-32 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10">
            <div class="space-y-8">
                <div class="inline-block bg-white/10 px-4 py-2 rounded-full backdrop-blur-sm border border-white/20">
                    <p class="text-primary font-bold text-sm uppercase tracking-widest"><?php echo htmlspecialchars(get_content('hero', 'badge')); ?></p>
                </div>
                <h1 class="text-5xl md:text-7xl serif-title leading-tight">
                    <?php echo get_content('hero', 'title'); ?>
                </h1>
                <p class="text-xl md:text-2xl font-light text-slate-300">
                    <?php echo get_content('hero', 'subtitle'); ?>
                </p>
                <div class="bg-white/5 border border-white/10 p-6 rounded-2xl inline-flex flex-col gap-4">
                    <p class="text-sm font-bold uppercase tracking-wider text-slate-400">Próximo inicio en:</p>
                    <div class="flex gap-6">
                        <div class="text-center">
                            <span id="days" class="block text-4xl font-black text-primary">07</span>
                            <span class="text-xs uppercase text-slate-400">Días</span>
                        </div>
                        <div class="text-center">
                            <span id="hours" class="block text-4xl font-black text-primary">08</span>
                            <span class="text-xs uppercase text-slate-400">Horas</span>
                        </div>
                        <div class="text-center">
                            <span id="minutes" class="block text-4xl font-black text-primary">52</span>
                            <span class="text-xs uppercase text-slate-400">Min</span>
                        </div>
                        <div class="text-center">
                            <span id="seconds" class="block text-4xl font-black text-primary">29</span>
                            <span class="text-xs uppercase text-slate-400">Seg</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <button
                        class="bg-primary text-black px-10 py-4 rounded-lg font-black text-lg hover:scale-105 transition-transform shadow-xl shadow-primary/20">
                        <?php echo htmlspecialchars(get_content('hero', 'cta1_text')); ?>
                    </button>
                </div>
            </div>
            <div class="relative">
                <div class="relative aspect-video bg-slate-900 rounded-2xl overflow-hidden border border-white/10">
                    <iframe class="w-full h-full" src="<?php echo htmlspecialchars(get_content('hero', 'video_url')); ?>" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen referrerpolicy="strict-origin-when-cross-origin"></iframe>
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-primary"></div>
                    <div class="absolute top-4 left-4 bg-primary text-black text-xs font-black px-3 py-1 rounded"><?php echo htmlspecialchars(get_content('hero', 'video_label')); ?></div>
                </div>
                <div>
                    <p class="text-center italic mt-4"><?php echo htmlspecialchars(get_content('hero', 'quote')); ?></p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-slate-50 py-24 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-6">
                    <h2 class="text-3xl md:text-6xl serif-title text-slate-900 leading-[1.1] font-thin">
                        <?php echo get_content('strategy', 'title'); ?>
                    </h2>
                
                    <div class="flex gap-8 items-center">
                        <div class="flex flex-col items-center gap-2">
                            <div class="w-16 h-16 rounded-2xl bg-primary/10 border border-primary/30 flex items-center justify-center">
                                <span class="material-symbols-outlined text-3xl text-black"><?php echo htmlspecialchars(get_content('strategy', 'icon1')); ?></span>
                            </div>
                            <span class="text-[10px] uppercase font-black tracking-widest text-slate-400"><?php echo htmlspecialchars(get_content('strategy', 'icon1_label')); ?></span>
                        </div>
                        <div class="w-12 h-[1px] bg-slate-200"></div>
                        <div class="flex flex-col items-center gap-2">
                            <div class="w-16 h-16 rounded-2xl bg-primary/10 border border-primary/30 flex items-center justify-center">
                                <span class="material-symbols-outlined text-3xl text-black"><?php echo htmlspecialchars(get_content('strategy', 'icon2')); ?></span>
                            </div>
                            <span class="text-[10px] uppercase font-black tracking-widest text-slate-400"><?php echo htmlspecialchars(get_content('strategy', 'icon2_label')); ?></span>
                        </div>
                    </div>
                </div>
                <div class="space-y-8">
                    <p class="md:text-2xl text-slate-500 font-light leading-relaxed">
                        <?php echo get_content('strategy', 'text'); ?>
                    </p>
                    <p class="md:text-lg text-slate-600 leading-relaxed border-l-2 border-primary pl-8">
                        <?php echo get_content('strategy', 'quote'); ?>
                    </p>
                    <div class="flex items-center gap-6 pt-4">
                        <div class="w-12 h-12 bg-primary rounded-sm rotate-45 flex-shrink-0"></div>
                        <div class="w-12 h-12 border-2 border-primary rounded-full flex-shrink-0"></div>
                        <div class="w-24 h-1 bg-primary"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 w-1/3 h-full bg-primary/5 -skew-x-12 translate-x-1/2"></div>
    </section>

    <section class="py-24 bg-white" id="why">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-4xl serif-title mb-6"><?php echo htmlspecialchars(get_content('why', 'title')); ?></h2>
                <p class="text-slate-600 text-lg"><?php echo htmlspecialchars(get_content('why', 'subtitle')); ?></p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="text-center space-y-4">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-4xl"><?php echo htmlspecialchars(get_content('why', 'feature1_icon')); ?></span>
                    </div>
                    <h3 class="text-xl font-bold"><?php echo htmlspecialchars(get_content('why', 'feature1_title')); ?></h3>
                    <p class="text-slate-600 leading-relaxed"><?php echo htmlspecialchars(get_content('why', 'feature1_text')); ?></p>
                </div>
                <div class="text-center space-y-4">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-4xl"><?php echo htmlspecialchars(get_content('why', 'feature2_icon')); ?></span>
                    </div>
                    <h3 class="text-xl font-bold"><?php echo htmlspecialchars(get_content('why', 'feature2_title')); ?></h3>
                    <p class="text-slate-600 leading-relaxed"><?php echo htmlspecialchars(get_content('why', 'feature2_text')); ?></p>
                </div>
                <div class="text-center space-y-4">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-4xl"><?php echo htmlspecialchars(get_content('why', 'feature3_icon')); ?></span>
                    </div>
                    <h3 class="text-xl font-bold"><?php echo htmlspecialchars(get_content('why', 'feature3_title')); ?></h3>
                    <p class="text-slate-600 leading-relaxed"><?php echo htmlspecialchars(get_content('why', 'feature3_text')); ?></p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-24 bg-slate-50" id="program">
        <div class="max-w-4xl mx-auto px-6">
            <h2 class="text-4xl serif-title text-center mb-16"><?php echo htmlspecialchars(get_content('program', 'title')); ?></h2>
            <div class="space-y-4">
                <details class="accordion-item bg-white border border-slate-200 rounded-xl overflow-hidden group">
                    <summary class="flex items-center justify-between p-6 cursor-pointer list-none">
                        <div class="flex items-center gap-4">
                            <span
                                class="bg-primary text-black font-black w-8 h-8 rounded-full flex items-center justify-center text-sm">01</span>
                            <h3 class="text-xl font-bold"><?php echo htmlspecialchars(get_content('program', 'module1_title')); ?></h3>
                        </div>
                        <span class="material-symbols-outlined summary-icon transition-transform">expand_more</span>
                    </summary>
                    <div class="p-6 border-t border-slate-100 text-slate-600 bg-slate-50/50">
                        <?php echo get_content('program', 'module1_content'); ?>
                    </div>
                </details>
                <details class="accordion-item bg-white border border-slate-200 rounded-xl overflow-hidden group">
                    <summary class="flex items-center justify-between p-6 cursor-pointer list-none">
                        <div class="flex items-center gap-4">
                            <span
                                class="bg-primary text-black font-black w-8 h-8 rounded-full flex items-center justify-center text-sm">02</span>
                            <h3 class="text-xl font-bold"><?php echo htmlspecialchars(get_content('program', 'module2_title')); ?></h3>
                        </div>
                        <span class="material-symbols-outlined summary-icon transition-transform">expand_more</span>
                    </summary>
                    <div class="p-6 border-t border-slate-100 text-slate-600 bg-slate-50/50">
                        <?php echo get_content('program', 'module2_content'); ?>
                    </div>
                </details>
                <details class="accordion-item bg-white border border-slate-200 rounded-xl overflow-hidden group">
                    <summary class="flex items-center justify-between p-6 cursor-pointer list-none">
                        <div class="flex items-center gap-4">
                            <span
                                class="bg-primary text-black font-black w-8 h-8 rounded-full flex items-center justify-center text-sm">03</span>
                            <h3 class="text-xl font-bold"><?php echo htmlspecialchars(get_content('program', 'module3_title')); ?></h3>
                        </div>
                        <span class="material-symbols-outlined summary-icon transition-transform">expand_more</span>
                    </summary>
                    <div class="p-6 border-t border-slate-100 text-slate-600 bg-slate-50/50">
                        <?php echo get_content('program', 'module3_content'); ?>
                    </div>
                </details>
                <div class="bg-amber-50 border border-amber-200 rounded-xl p-6">
                    <?php echo get_content('program', 'outcomes'); ?>
                </div>
            </div>
        </div>
    </section>
    <section class="py-24 bg-white border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-black text-white rounded-3xl p-12 overflow-hidden relative">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 relative z-10">
                    <div class="space-y-4">
                        <span class="material-symbols-outlined text-primary text-4xl">timer</span>
                        <h4 class="font-bold text-lg"><?php echo htmlspecialchars(get_content('info', 'duration_title')); ?></h4>
                        <p class="text-slate-400"><?php echo htmlspecialchars(get_content('info', 'duration_text')); ?></p>
                    </div>
                    <div class="space-y-4">
                        <span class="material-symbols-outlined text-primary text-4xl">videocam</span>
                        <h4 class="font-bold text-lg"><?php echo htmlspecialchars(get_content('info', 'format_title')); ?></h4>
                        <p class="text-slate-400"><?php echo htmlspecialchars(get_content('info', 'format_text')); ?></p>
                    </div>
                    <div class="space-y-4">
                        <span class="material-symbols-outlined text-primary text-4xl">cloud_done</span>
                        <h4 class="font-bold text-lg"><?php echo htmlspecialchars(get_content('info', 'recordings_title')); ?></h4>
                        <p class="text-slate-400"><?php echo htmlspecialchars(get_content('info', 'recordings_text')); ?></p>
                    </div>
                    <div class="space-y-4">
                        <span class="material-symbols-outlined text-primary text-4xl">badge</span>
                        <h4 class="font-bold text-lg"><?php echo htmlspecialchars(get_content('info', 'certification_title')); ?></h4>
                        <p class="text-slate-400"><?php echo htmlspecialchars(get_content('info', 'certification_text')); ?></p>
                    </div>
                </div>
                <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>
            </div>
        </div>
    </section>
    <section class="py-24 bg-slate-50 border-y border-slate-100" id="instructor">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
                <div class="lg:col-span-5 flex justify-center">
                    <div class="relative">
                        <div
                            class="w-64 h-64 md:w-80 md:h-80 rounded-full border-8 border-primary overflow-hidden shadow-2xl">
                            <img alt="Instructor Profile" class="w-full h-full object-cover"
                                src="<?php echo htmlspecialchars(get_content('instructor', 'image')); ?>" />
                        </div>
                        <div
                            class="absolute -bottom-4 -right-4 bg-black text-white p-4 rounded-2xl shadow-lg border border-primary/20">
                            <p class="font-black text-sm tracking-tighter uppercase"><?php echo htmlspecialchars(get_content('instructor', 'badge1')); ?></p>
                            <p class="text-primary text-xs uppercase tracking-widest font-bold"><?php echo htmlspecialchars(get_content('instructor', 'badge2')); ?></p>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-7 space-y-6">
                    <h2 class="text-4xl serif-title"><?php echo htmlspecialchars(get_content('instructor', 'title')); ?></h2>
                    <div class="space-y-4 text-slate-700 leading-relaxed text-lg">
                        <?php echo get_content('instructor', 'bio'); ?>
                    </div>
                    <a class="inline-flex items-center gap-2 bg-primary text-black px-6 py-3 rounded-lg font-black hover:brightness-95 transition-all shadow-md"
                        href="<?php echo htmlspecialchars(get_content('instructor', 'linkedin_url')); ?>">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4 0-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z">
                            </path>
                        </svg>
                        Conectar en LinkedIn
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="py-24 bg-white" id="whom">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div>
                    <h2 class="text-4xl serif-title mb-8"><?php echo htmlspecialchars(get_content('whom', 'title')); ?></h2>
                    <ul
                        class="yellow-chevron-list text-lg font-medium space-y-4 grid grid-cols-1 md:grid-cols-2 gap-x-8">
                        <?php echo get_content('whom', 'list'); ?>
                    </ul>
                </div>
                <div
                    class="bg-primary p-12 rounded-3xl relative overflow-hidden flex flex-col justify-center min-h-[400px]">
                    <div class="relative z-10 text-black">
                        <p class="text-4xl font-black mb-4"><?php echo htmlspecialchars(get_content('whom', 'ideal_title')); ?></p>
                        <p class="text-xl opacity-90 mb-6"><?php echo htmlspecialchars(get_content('whom', 'ideal_text')); ?></p>
                        <div class="flex flex-wrap gap-4">
                            <span class="bg-black/5 px-4 py-2 rounded-lg font-bold border border-black/10"><?php echo htmlspecialchars(get_content('whom', 'tag1')); ?></span>
                            <span class="bg-black/5 px-4 py-2 rounded-lg font-bold border border-black/10"><?php echo htmlspecialchars(get_content('whom', 'tag2')); ?></span>
                            <span class="bg-black/5 px-4 py-2 rounded-lg font-bold border border-black/10"><?php echo htmlspecialchars(get_content('whom', 'tag3')); ?></span>
                            <span class="bg-black/5 px-4 py-2 rounded-lg font-bold border border-black/10"><?php echo htmlspecialchars(get_content('whom', 'tag4')); ?></span>
                        </div>
                    </div>
                    <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-black/5 rounded-full blur-3xl"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-24 bg-slate-50" id="pricing">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-4xl serif-title mb-16"><?php echo htmlspecialchars(get_content('pricing', 'title')); ?></h2>
            <div class="max-w-md mx-auto bg-white rounded-3xl border-2 border-primary shadow-2xl overflow-hidden">
                <div class="p-12 space-y-8">
                    <div class="space-y-2">
                        <p class="text-slate-500 font-bold uppercase tracking-widest text-sm">Pago Único</p>
                        <p class="text-6xl font-black text-black"><?php echo htmlspecialchars(get_content('pricing', 'price')); ?><span class="text-xl text-slate-400"><?php echo htmlspecialchars(get_content('pricing', 'currency')); ?></span>
                        </p>
                    </div>
                    <ul class="text-left space-y-4 text-slate-600">
                        <?php echo get_content('pricing', 'features'); ?>
                    </ul>
                    <button
                        class="w-full bg-primary text-black py-4 rounded-xl font-black text-lg hover:scale-[1.02] transition-transform shadow-lg shadow-primary/20">
                        <?php echo htmlspecialchars(get_content('pricing', 'button_text')); ?>
                    </button>
                    <p class="text-xs text-slate-400"><?php echo htmlspecialchars(get_content('pricing', 'guarantee')); ?></p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-4xl serif-title text-center mb-16"><?php echo htmlspecialchars(get_content('testimonials', 'title')); ?></h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-slate-50 p-8 rounded-2xl border border-slate-100 flex flex-col h-full">
                    <p class="text-slate-600 mb-8 italic"><?php echo htmlspecialchars(get_content('testimonials', 'test1_text')); ?></p>
                    <div class="mt-auto flex items-center gap-4 border-t border-slate-200 pt-6">
                        <img alt="" class="w-12 h-12 rounded-full border-2 border-primary"
                            src="<?php echo htmlspecialchars(get_content('testimonials', 'test1_image')); ?>" />
                        <div>
                            <h4 class="font-bold text-sm"><?php echo htmlspecialchars(get_content('testimonials', 'test1_name')); ?></h4>
                            <p class="text-xs text-slate-500"><?php echo htmlspecialchars(get_content('testimonials', 'test1_role')); ?></p>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 p-8 rounded-2xl border border-slate-100 flex flex-col h-full">
                    <p class="text-slate-600 mb-8 italic"><?php echo htmlspecialchars(get_content('testimonials', 'test2_text')); ?></p>
                    <div class="mt-auto flex items-center gap-4 border-t border-slate-200 pt-6">
                        <img alt="" class="w-12 h-12 rounded-full border-2 border-primary"
                            src="<?php echo htmlspecialchars(get_content('testimonials', 'test2_image')); ?>" />
                        <div>
                            <h4 class="font-bold text-sm"><?php echo htmlspecialchars(get_content('testimonials', 'test2_name')); ?></h4>
                            <p class="text-xs text-slate-500"><?php echo htmlspecialchars(get_content('testimonials', 'test2_role')); ?></p>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 p-8 rounded-2xl border border-slate-100 flex flex-col h-full">
                    <p class="text-slate-600 mb-8 italic"><?php echo htmlspecialchars(get_content('testimonials', 'test3_text')); ?></p>
                    <div class="mt-auto flex items-center gap-4 border-t border-slate-200 pt-6">
                        <img alt="" class="w-12 h-12 rounded-full border-2 border-primary"
                            src="<?php echo htmlspecialchars(get_content('testimonials', 'test3_image')); ?>" />
                        <div>
                            <h4 class="font-bold text-sm"><?php echo htmlspecialchars(get_content('testimonials', 'test3_name')); ?></h4>
                            <p class="text-xs text-slate-500"><?php echo htmlspecialchars(get_content('testimonials', 'test3_role')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-24 bg-slate-50">
        <div class="max-w-3xl mx-auto px-6">
            <h2 class="text-4xl serif-title text-center mb-16"><?php echo htmlspecialchars(get_content('faq', 'title')); ?></h2>
            <div class="space-y-4">
                <details class="accordion-item bg-white border border-slate-200 rounded-xl overflow-hidden group">
                    <summary class="flex items-center justify-between p-6 cursor-pointer list-none">
                        <h3 class="font-bold"><?php echo htmlspecialchars(get_content('faq', 'q1')); ?></h3>
                        <span class="material-symbols-outlined summary-icon transition-transform">expand_more</span>
                    </summary>
                    <div class="p-6 border-t border-slate-100 text-slate-600">
                        <?php echo htmlspecialchars(get_content('faq', 'a1')); ?>
                    </div>
                </details>
                <details class="accordion-item bg-white border border-slate-200 rounded-xl overflow-hidden group">
                    <summary class="flex items-center justify-between p-6 cursor-pointer list-none">
                        <h3 class="font-bold"><?php echo htmlspecialchars(get_content('faq', 'q2')); ?></h3>
                        <span class="material-symbols-outlined summary-icon transition-transform">expand_more</span>
                    </summary>
                    <div class="p-6 border-t border-slate-100 text-slate-600">
                        <?php echo htmlspecialchars(get_content('faq', 'a2')); ?>
                    </div>
                </details>
                <details class="accordion-item bg-white border border-slate-200 rounded-xl overflow-hidden group">
                    <summary class="flex items-center justify-between p-6 cursor-pointer list-none">
                        <h3 class="font-bold"><?php echo htmlspecialchars(get_content('faq', 'q3')); ?></h3>
                        <span class="material-symbols-outlined summary-icon transition-transform">expand_more</span>
                    </summary>
                    <div class="p-6 border-t border-slate-100 text-slate-600">
                        <?php echo htmlspecialchars(get_content('faq', 'a3')); ?>
                    </div>
                </details>
            </div>
        </div>
    </section>
    <section class="py-24 bg-black text-white">
        <div class="max-w-3xl mx-auto px-6 text-center">
            <h2 class="text-4xl serif-title mb-4"><?php echo htmlspecialchars(get_content('contact', 'title')); ?></h2>
            <p class="text-slate-400 mb-12 text-lg"><?php echo htmlspecialchars(get_content('contact', 'subtitle')); ?></p>
            <form class="space-y-6 text-left">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold mb-2 text-slate-300">Nombre</label>
                        <input
                            class="w-full bg-transparent border-2 border-primary focus:border-primary rounded-xl px-4 py-3 text-white transition-all outline-none"
                            placeholder="Tu nombre" type="text" />
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2 text-slate-300">Email</label>
                        <input
                            class="w-full bg-transparent border-2 border-primary focus:border-primary rounded-xl px-4 py-3 text-white transition-all outline-none"
                            placeholder="tu@correo.com" type="email" />
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2 text-slate-300">Mensaje</label>
                    <textarea
                        class="w-full bg-transparent border-2 border-primary focus:border-primary rounded-xl px-4 py-3 text-white transition-all outline-none"
                        placeholder="¿En qué mes te gustaría participar?" rows="4"></textarea>
                </div>
                <button
                    class="w-full bg-primary text-black py-4 rounded-xl font-black text-lg hover:brightness-90 transition-all shadow-lg shadow-primary/10"
                    type="submit">
                    <?php echo htmlspecialchars(get_content('contact', 'button_text')); ?>
                </button>
            </form>
        </div>
    </section>
    <footer class="bg-black text-white py-16 border-t border-white/10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-1 md:col-span-2 space-y-6">
                    <div class="flex items-center gap-2">
                        <div class="text-primary">
                            <svg class="w-10 h-10" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.8261 17.4264C16.7203 18.1174 20.2244 18.5217 24 18.5217C27.7756 18.5217 31.2797 18.1174 34.1739 17.4264C36.9144 16.7722 39.9967 15.2331 41.3563 14.1648L24.8486 40.6391C24.4571 41.267 23.5429 41.267 23.1514 40.6391L6.64374 14.1648C8.00331 15.2331 11.0856 16.7722 13.8261 17.4264Z"
                                    fill="currentColor"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-black tracking-tighter"><?php echo htmlspecialchars(get_content('footer', 'logo_alt')); ?></h2>
                    </div>
                    <p class="text-slate-400 max-w-sm">
                        <?php echo htmlspecialchars(get_content('footer', 'text')); ?>
                    </p>
                    <p class="text-primary font-black serif-title text-xl mt-8"><?php echo htmlspecialchars(get_content('footer', 'tagline')); ?></p>
                </div>
                <div>
                    <h5 class="font-bold text-lg mb-6">Contacto</h5>
                    <ul class="space-y-4 text-slate-400">
                        <li class="hover:text-primary cursor-pointer transition-colors"><?php echo htmlspecialchars(get_content('footer', 'contact_email')); ?></li>
                        <li class="hover:text-primary cursor-pointer transition-colors"><?php echo htmlspecialchars(get_content('footer', 'contact_location')); ?></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-bold text-lg mb-6">Síguenos</h5>
                    <div class="flex gap-6">
                        <a class="text-slate-400 hover:text-primary transition-all" href="<?php echo htmlspecialchars(get_content('footer', 'social_linkedin')); ?>">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div
                class="pt-8 border-t border-white/5 text-slate-500 text-sm flex flex-col md:flex-row justify-between gap-4">
                <p><?php echo htmlspecialchars(get_content('footer', 'copyright')); ?></p>
                <div class="flex gap-8">
                    <a class="hover:text-white" href="#"><?php echo htmlspecialchars(get_content('footer', 'privacy')); ?></a>
                    <a class="hover:text-white" href="#"><?php echo htmlspecialchars(get_content('footer', 'terms')); ?></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>