<?php
$year = date("Y");
?>

<footer class="bg-muted border-t border-border py-12">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-4 gap-8 mb-8">
            <div>
                <a href="/"
                    class="text-xl font-bold text-primary hover:text-primary/90 transition-colors block mb-4">
                    <img src="./assets/img/lakeland_commissary__1__720.png" style="width: 250px;" alt="Lakeland Commissary Logo">
                </a>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Supporting Lakeland, Polk County, and Central Florida's food and beverage businesses with innovative solutions, expert guidance, and comprehensive support from A to Z.</p>

                <!-- CONTACT -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-envelope text-muted-foreground text-sm"></i>
                        <span class="text-sm text-muted-foreground">info@lakelandcommissary.com</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-globe text-muted-foreground text-sm"></i>
                        <a
                            href="https://lakelandcommissary.com"
                            class="text-sm text-muted-foreground hover:text-primary transition-colors">lakelandcommissary.com</a>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-phone text-muted-foreground text-sm"></i>
                        <span class="text-sm text-muted-foreground">(123) 456-7890</span>
                    </div>
                </div>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Quick Links</h4>
                <nav class="flex flex-col gap-2">
                    <a href="#home"
                        class="text-sm text-muted-foreground hover:text-primary transition-colors">Home</a>
                    <a href="#services"
                        class="text-sm text-muted-foreground hover:text-primary transition-colors">Services</a>
                    <a href="#about"
                        class="text-sm text-muted-foreground hover:text-primary transition-colors">About Us</a>
                    <a
                        href="#contact"
                        class="text-sm text-muted-foreground hover:text-primary transition-colors">Contact</a>
                </nav>
            </div>
            <div>
                <h4 class="text-lg font-bold mb-6">Services</h4>
                <ul class="space-y-3">
                    <li>
                        <a
                            href="service"
                            class="text-sm text-muted-foreground hover:text-primary transition-colors">Commissary Kitchen</a>
                    </li>
                    <li>
                        <a
                            href="service"
                            class="text-sm text-muted-foreground hover:text-primary transition-colors">Business Licensing</a>
                    </li>
                    <li>
                        <a
                            href="service"
                            class="text-sm text-muted-foreground hover:text-primary transition-colors">Catering Services</a>
                    </li>
                    <li>
                        <a
                            href="service"
                            class="text-sm text-muted-foreground hover:text-primary transition-colors">Food Truck Rental</a>
                    </li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Newsletter</h4>
                <form class="flex gap-2" id="newsletter-form">
                    <input type="email" data-slot="input" id="newsletter-email"
                        class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input h-9 w-full min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive flex-1"
                        placeholder="Your email" require />
                    <button data-slot="button"
                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*=&#x27;size-&#x27;])]:size-4 shrink-0 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive bg-primary text-primary-foreground hover:bg-primary/90 size-9"
                        type="submit" style="width: 50px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            class="lucide lucide-mail h-4 w-4">
                            <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                        </svg>
                        <span class="sr-only">Subscribe</span>
                    </button>
                </form>
                <p class="text-xs text-muted-foreground mt-2">Get updates on new services and offers</p>
                <!-- SOCIAL -->
                <div class="py-3 flex gap-4"><a href="https://facebook.com" target="_blank" rel="noopener noreferrer"
                        class="text-muted-foreground hover:text-primary transition-colors">
                        <svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor"
                            class="lucide lucide-facebook h-5 w-5">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                        </svg>
                        <span class="sr-only">Facebook</span>
                    </a>
                    <a href="https://instagram.com"
                        target="_blank" rel="noopener noreferrer"
                        class="text-muted-foreground hover:text-primary transition-colors">
                        <svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor"
                            class="lucide lucide-instagram h-5 w-5">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                        </svg>
                        <span class="sr-only">Instagram</span>
                    </a>
                    <a href="https://twitter.com"
                        target="_blank" rel="noopener noreferrer"
                        class="text-muted-foreground hover:text-primary transition-colors">
                        <svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor"
                            class="lucide lucide-twitter h-5 w-5">
                            <path
                                d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z">
                            </path>
                        </svg>
                        <span class="sr-only">Twitter</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="border-t border-border pt-8 text-center text-sm text-muted-foreground">
            <p>©<?php echo $year ?> Lakeland Commissary. All rights reserved.</p>
        </div>
    </div>
</footer>

<script>
    async function subscribeToNotifications(email) {
        try {
            const response = await fetch('http://localhost/BroadwayCommissary/api/email/subscribe', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    email
                })
            });

            const data = await response.json();

            if (data.success) {
                console.log('Subscribed successfully!');
            } else {
                console.error('Error:', data.message);
            }
        } catch (error) {
            console.error('Request failed:', error);
        }
    }

    document.getElementById('newsletter-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const emailInput = document.getElementById('newsletter-email');
        const email = emailInput.value.trim();

        if (!email) {
            alert('Email not valid');
            emailInput.focus();
            return;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('Email format not valid');
            emailInput.focus();
            return;
        }

        subscribeToNotifications(email);
    });
</script>