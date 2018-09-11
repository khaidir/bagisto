<div class="footer">
    <div class="footer-content">
        <div class="footer-list-container">
            <div class="list-container">
                <span class="list-heading">Categories</span>
                <ul class="list-group">
                    <li>MEN</li>
                    <li>Women</li>
                    <li>Kids</li>
                    <li>Accessories</li>
                    <li>Home & Living</li>
                </ul>
            </div>
            <div class="list-container">
                <span class="list-heading">Quick Links</span>
                <ul class="list-group">
                    <li>About Us</li>
                    <li>Return Policy</li>
                    <li>Refund Policy</li>
                    <li>Terms and conditions</li>
                    <li>Terms of Use</li>
                    <li>Contact Us</li>
                </ul>
            </div>
            <div class="list-container">
                <span class="list-heading">Connect With Us</span>
                <ul class="list-group">
                    <li><span class="icon-wrapper"><span class="icon icon-dashboard"></span></span>Facebook</li>
                    <li><span class="icon-wrapper"><span class="icon icon-dashboard"></span></span>Twitter</li>
                    <li><span class="icon-wrapper"><span class="icon icon-dashboard"></span></span>Instagram</li>
                    <li><span class="icon-wrapper"><span class="icon icon-dashboard"></span></span>Google+</li>
                    <li><span class="icon-wrapper"><span class="icon icon-dashboard"></span></span>LinkedIn</li>

                </ul>
            </div>
            <div class="list-container">
                <span class="list-heading">Subscribe Newsletter</span>
                <form method="POST" action="{{ route('subscribewithus') }}" name="">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="form-container">
                        <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                            <input type="text" class="control subscribe-field" name="email" v-validate="'required|email'" placeholder="{{ __('shop::app.footer.subscription-field') }}">
                            <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                            <button class="btn btn-md btn-primary">Subscribe</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
