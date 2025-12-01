<section id="contact" class="py-20 md:py-28">
    <div class="container mx-auto px-4">
        <div>
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-5xl font-bold text-balance mb-4">Get in Touch</h2>
                <p class="text-lg text-muted-foreground leading-relaxed">Ready to start your food business
                    journey? Contact us today.</p>
            </div>
            <section class="py-20 bg-white">
                <div class="max-w-7xl mx-auto px-6">
                    <div class="grid lg:grid-cols-3 gap-8">
                        <!-- Contact Form -->
                        <div class="lg:col-span-2">
                            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                                <h3 class="text-2xl font-bold text-gray-900 mb-6">Send Us a Message</h3>
                                <form id="contactForm" class="space-y-6">
                                    <!-- Name & Email -->
                                    <div class="grid md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                            <input type="text" id="name" name="name"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors field-input">
                                        </div>
                                        <div>
                                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                            <input type="email" id="email" name="email"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors field-input">
                                        </div>
                                    </div>

                                    <!-- Phone & Business Type -->
                                    <div class="grid md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                            <input type="tel" id="phone" name="phone"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors field-input">
                                        </div>
                                        <div>
                                            <label for="businessType" class="block text-sm font-medium text-gray-700 mb-2">Business Type</label>
                                            <select id="businessType" name="businessType"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors field-input">
                                                <option value="">Select a business type...</option>
                                                <option value="catering">Catering Company</option>
                                                <option value="foodtruck">Food Truck</option>
                                                <option value="restaurant">Restaurant</option>
                                                <option value="bakery">Bakery</option>
                                                <option value="commissary">Commissary Kitchen</option>
                                                <option value="other">Other Food Business</option>
                                                <option value="nonFood">Non-Food Business</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Subject -->
                                    <div>
                                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject *</label>
                                        <input type="text" id="subject" name="subject"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors field-input">
                                    </div>

                                    <!-- Message -->
                                    <div>
                                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                                        <textarea id="message" name="message" rows="5"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors field-input"></textarea>
                                    </div>

                                    <!-- Services Interested In -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-3">Services Interested In</label>
                                        <div class="grid md:grid-cols-2 gap-4">
                                            <div class="space-y-3">
                                                <label class="flex items-center">
                                                    <input type="checkbox" name="services[]" value="Commissary Kitchen" class="rounded border-gray-300 text-primary focus:ring-primary mr-3">
                                                    <span class="text-gray-700">Commissary Kitchen</span>
                                                </label>
                                                <label class="flex items-center">
                                                    <input type="checkbox" name="services[]" value="Food Manager's Exam" class="rounded border-gray-300 text-primary focus:ring-primary mr-3">
                                                    <span class="text-gray-700">Food Manager's Exam</span>
                                                </label>
                                                <label class="flex items-center">
                                                    <input type="checkbox" name="services[]" value="LLC/EIN" class="rounded border-gray-300 text-primary focus:ring-primary mr-3">
                                                    <span class="text-gray-700">LLC/EIN</span>
                                                </label>
                                                <label class="flex items-center">
                                                    <input type="checkbox" name="services[]" value="BTR Registration" class="rounded border-gray-300 text-primary focus:ring-primary mr-3">
                                                    <span class="text-gray-700">BTR Registration</span>
                                                </label>
                                            </div>
                                            <div class="space-y-3">
                                                <label class="flex items-center">
                                                    <input type="checkbox" name="services[]" value="Catering Services" class="rounded border-gray-300 text-primary focus:ring-primary mr-3">
                                                    <span class="text-gray-700">Catering Services</span>
                                                </label>
                                                <label class="flex items-center">
                                                    <input type="checkbox" name="services[]" value="DBPR/FDACS License" class="rounded border-gray-300 text-primary focus:ring-primary mr-3">
                                                    <span class="text-gray-700">DBPR/FDACS License</span>
                                                </label>

                                                <label class="flex items-center">
                                                    <input type="checkbox" name="services[]" value="Sales Tax Registration" class="rounded border-gray-300 text-primary focus:ring-primary mr-3">
                                                    <span class="text-gray-700">Sales Tax Registration</span>
                                                </label>

                                                <label class="flex items-center">
                                                    <input type="checkbox" name="services[]" value="Other Services" class="rounded border-gray-300 text-primary focus:ring-primary mr-3">
                                                    <span class="text-gray-700">Other Services</span>
                                                </label>
                                            </div>

                                        </div>
                                    </div>

                                    <div style="margin-bottom: 2rem;">
                                        <label for="findUs" class="block text-sm font-medium text-gray-700 mb-2">How did you find us? *</label>
                                        <select class="form-select" id="findUs" name="findUs">
                                            <option value="" selected>-- Select --</option>
                                            <option value="Google Search">Google Search</option>
                                            <option value="Google Maps">Google Maps</option>
                                            <option value="Apple Maps">Apple Maps</option>
                                            <option value="Facebook">Facebook</option>
                                            <option value="Instagram">Instagram</option>
                                            <option value="Referral">Referral</option>
                                            <option value="Other">Other</option>
                                        </select>

                                    </div>
                                    <!-- Submit Button -->
                                    <button type="submit"
                                        class="w-full bg-primary text-white py-4 px-6 rounded-lg hover:bg-blue-600 transition-colors font-semibold text-lg flex items-center justify-center">
                                        <i class="fas fa-paper-plane mr-3"></i>
                                        Send Message
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- Contact Information -->
                        <div class="lg:col-span-1">
                            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                                <h3 class="text-2xl font-bold text-gray-900 mb-6">Contact Information</h3>

                                <div class="space-y-6">
                                    <!-- Email -->
                                    <div class="flex items-start">
                                        <div class="w-12 h-12 flex items-center justify-center bg-primary bg-opacity-10 rounded-lg mr-4">
                                            <i class="fas fa-envelope text-primary text-lg"></i>
                                        </div>
                                        <div>
                                            <h5 class="font-semibold text-gray-900 mb-1">Email</h5>
                                            <a href="mailto:info@lakelandcommissary.com" class="text-primary hover:text-blue-600 transition-colors">
                                                info@lakelandcommissary.com
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="flex items-start">
                                        <div class="w-12 h-12 flex items-center justify-center bg-primary bg-opacity-10 rounded-lg mr-4">
                                            <i class="fas fa-phone text-primary text-lg"></i>
                                        </div>
                                        <div>
                                            <h5 class="font-semibold text-gray-900 mb-1">Phone</h5>
                                            <a href="tel:+1234567890" class="text-primary hover:text-blue-600 transition-colors">
                                                (123) 456-7890
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Website -->
                                    <div class="flex items-start">
                                        <div class="w-12 h-12 flex items-center justify-center bg-primary bg-opacity-10 rounded-lg mr-4">
                                            <i class="fas fa-globe text-primary text-lg"></i>
                                        </div>
                                        <div>
                                            <h5 class="font-semibold text-gray-900 mb-1">Website</h5>
                                            <a href="http://lakelandcommissary.com/" target="_blank" class="text-primary hover:text-blue-600 transition-colors">
                                                lakelandcommissary.com
                                            </a>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="w-12 h-12 flex items-center justify-center bg-primary bg-opacity-10 rounded-lg mr-4">
                                            <i class="fas fa-clock text-primary text-lg"></i>
                                        </div>
                                        <div>

                                            <h5 class="font-semibold text-gray-900 mb-1">Response Time</h5>
                                            <p class="text-gray-600">We typically respond within <br>24 hours of your inquiry.</p>

                                        </div>
                                    </div>

                                    <hr>
                                    <!-- Contact Person -->
                                    <div class="flex items-start">
                                        <div class="w-12 h-12 flex items-center justify-center bg-primary bg-opacity-10 rounded-lg mr-4">
                                            <i class="fas fa-user text-primary text-lg"></i>
                                        </div>
                                        <div>
                                            <h5 class="font-semibold text-gray-900 mb-1">Location</h5>
                                            <p class="text-gray-600">
                                                <strong>927 Pisgah Pl</strong><br>
                                                Lakeland, FL 33801
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Response Time -->
                                    <div class="flex items-start">
                                        <div class="w-12 h-12 flex items-center justify-center bg-primary bg-opacity-10 rounded-lg mr-4">
                                            <i class="fas fa-clock text-primary text-lg"></i>
                                        </div>

                                        <div>
                                            <!-- <p class="text-gray-600"><strong>Office Hours:</strong></p> -->
                                            <h5 class="font-semibold text-gray-900 mb-1">Office Hours:</h5>
                                            <p class="text-gray-600">By Appointment Only</p>

                                        </div>

                                    </div>
                                    <div class="flex items-start">
                                        <div class="w-12 h-12 flex items-center justify-center bg-primary bg-opacity-10 rounded-lg mr-4">
                                            <i class="fas fa-clock text-primary text-lg"></i>
                                        </div>

                                        <div>
                                            <!-- <p class="text-gray-600"><strong>Kitchen Hours:</strong></p> -->
                                            <h5 class="font-semibold text-gray-900 mb-1">Kitchen Hours:</h5>
                                            <p class="text-gray-600">24/7</p>

                                        </div>

                                    </div>
                                </div>

                                <!-- Why Choose Us Card -->
                                <div class="mt-8 p-6 bg-primary bg-opacity-5 rounded-xl border border-primary border-opacity-20">
                                    <div class="flex items-center mb-3">
                                        <i class="fas fa-star text-primary mr-2"></i>
                                        <h6 class="font-semibold text-gray-900">Why Choose Us?</h6>
                                    </div>
                                    <p class="text-sm text-gray-600">
                                        Expert Florida licensing guidance • Fast turnaround • Personalized service • Ongoing support
                                    </p>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </section>
        </div>
    </div>
</section>

<script>
    async function submitContactForm(formData) {
        grecaptcha.ready(function() {
            grecaptcha.execute('6LdOKx4sAAAAAFa7X3Lp-4coqXyEpHwOGXq_vKl5', {
                    action: 'submit'
                })
                .then(async function(token) {
                    formData.recaptcha_token = token;
                    try {
                        const response = await fetch('http://localhost/BroadwayCommissary/api/contact/submit', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(formData)
                        });

                        const data = await response.json();

                        if (data.success) {
                            console.log('Form submitted successfully!');
                        } else {
                            console.error('Validation errors:', data.errors);
                        }
                    } catch (error) {
                        console.error('Request failed:', error);
                    }
                });
        });
    }

    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        const data = {
            name: formData.get('name'),
            email: formData.get('email'),
            phone: formData.get('phone'),
            businessType: formData.get('businessType'),
            subject: formData.get('subject'),
            message: formData.get('message'),
            services: formData.getAll('services[]'),
            ip_address: window.location.hostname
        };

        submitContactForm(data);
    });
</script>