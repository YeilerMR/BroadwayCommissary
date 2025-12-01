<header class="border-b border-border sticky top-0 z-50 headerBG">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
        <a href="/" class="text-2xl font-bold text-primary hover:text-primary/90 transition-colors headerText flex-shrink-0">
            <img src="./assets/img/lakeland_commissary__1__720.png" style="width: 200px; max-width: 80vw;" alt="Lakeland Commissary Logo">
        </a>
        
        <nav id="desktopNav" class="items-center gap-8 text-xl" style="display: none;">
            <a href="#home" class="hover:text-primary transition-colors headerText">
                Home
            </a>
            <a href="#services" class="hover:text-primary transition-colors headerText">
                Services
            </a>
            <a href="#about" class="hover:text-primary transition-colors headerText">
                About Us
            </a>
            <a href="#contact" class="hover:text-primary transition-colors headerText">
                Contact
            </a>
        </nav>

        <button id="mobileMenuBtn" class="flex-shrink-0" style="display: none; background: none; border: none; cursor: pointer; padding: 8px; margin-right: 8px;">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="stroke: var(--background); width: 24px; height: 24px;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <nav id="mobileMenu" style="display: none; background-color: var(--card); border-top: 1px solid var(--border);">
        <div class="container mx-auto px-4 py-4 flex flex-col gap-4" style="font-size: 18px;">
            <a href="#home" style="color: var(--foreground); text-decoration: none; padding: 8px 0; display: block;" class="hover:text-primary transition-colors">
                Home
            </a>
            <a href="#services" style="color: var(--foreground); text-decoration: none; padding: 8px 0; display: block;" class="hover:text-primary transition-colors">
                Services
            </a>
            <a href="#about" style="color: var(--foreground); text-decoration: none; padding: 8px 0; display: block;" class="hover:text-primary transition-colors">
                About Us
            </a>
            <a href="#contact" style="color: var(--foreground); text-decoration: none; padding: 8px 0; display: block;" class="hover:text-primary transition-colors">
                Contact
            </a>
        </div>
    </nav>
</header>