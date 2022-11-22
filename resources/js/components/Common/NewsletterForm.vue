<template>
    <div class="container">
        <div class="subscribe-wrp">
            <div class="left-block-d">
                <h3 class="heading">Join the Seen community</h3>
                <p class="p-txt">Join over 10,000 users to enjoy a regular dose of inspiration and motivation, delivered to your inbox every week.</p>
                <div id="success_div" style="color: white;"></div>
                <form action="" class="subscribe-form">
                    
                    <div class="form-group">
                        <div class="input-wrp">
                            <input v-model="form.email" class="form-control-s" placeholder="Your email address" type="email" >
                            <span class="error-text"></span>
                        </div>
                        <button class="btn btn-outline-light" type="button" v-on:click='this.$emit("saveNewsletter", form)' :disabled="saveDisabled"><span v-if="!loading">Subscribe</span><span v-else><i class="fas fa-spinner"></i> Subscribe</span></button>
                    </div>
                </form>
            </div>
            <div class="right-block-d" :style="`background-image: url('${ asset }/assets/images/subscribe-right-img.png');`">
                <div class="img-box">
                    <img :src="asset+'/assets/images/subscribe-right-img.png'" alt="">
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import * as methods from '../Common/helper';

    export default {
        name: 'NewsletterForm',
        props: ['form', 'loading', 'saveDisabled'],
        
        beforeMount() {
            this.asset = methods.asset();
        },

        data() {
            return {
                asset: '',
            }
        },
    }
</script>
