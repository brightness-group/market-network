<template>
    <form action="" class="form-layout-view-style">
        <div class="form-group">
            <input type="hidden" v-model="form.type" class="form-control">
        </div>
        <div class="form-group">
            <label for="pkgprice" class="small-label">PACKAGE PRICE </label>
            <input v-model='form.price' class="form-control" type="text" name="" >
            <small class="validation-info correct-icon "></small>
            <span class="mendetory-dot d-none"><i class="icon-icon_form_required"></i></span>
            <small class="error-text d-none">validation Error text</small>
        </div>
        <div class="form-group">
            <label for="" class="small-label">PRICE PER </label>
            <input v-model='form.per_price' class="form-control" type="text"  placeholder="Per Price">                                              
            <small class="validation-info correct-icon "></small>
            <span class="mendetory-dot d-none"><i class="icon-icon_form_required"></i></span>
            <small class="error-text d-none">validation Error text</small>
        </div>

        <div class="form-group">
            <label for="" class="small-label">PACKAGE OFFERS </label>
            <input v-model='form.offer' class="form-control" type="text"  placeholder="No offers for this package">                                              
            <small class="validation-info correct-icon "></small>
            <span class="mendetory-dot d-none"><i class="icon-icon_form_required"></i></span>
            <small class="error-text d-none">validation Error text</small>
        </div>

        <div class="form-group">
            <label for="description" class="small-label">PACKAGE DISCRIPTION</label>
            <textarea v-model='form.description' placeholder="Keep it brief… max. 200 characters" class="form-control cstm-text-area"></textarea>
            <span class="mendetory-dot"><i class="icon-icon_form_required"></i></span>
            <small class="error-text d-none">validation Error text</small>
        </div>

        <div class="form-group">
            <label for="whtsinclde" class="small-label">WHATS INCLUDED? </label>
            <input v-model='form.includes' class="form-control" type="text" name="">
            <small class="validation-info correct-icon "></small>
            <span class="mendetory-dot d-none"><i class="icon-icon_form_required"></i></span>
            <small class="error-text d-none">validation Error text</small>
        </div>
        <div class="form-group">
            <label for="pkgprice" class="small-label">PACKAGE QUANTITY </label>
            <div class="quantity-input-group">
                <span class="minus">-</span>
                 <input v-model='form.quantity' class="form-control" type="text" name="" placeholder="Package Quantity" >
                <span class="plus">+</span>
            </div>
           
            <small class="validation-info correct-icon "></small>
            <span class="mendetory-dot d-none"><i class="icon-icon_form_required"></i></span>
            <small class="error-text d-none">validation Error text</small>
        </div>

        <div class="row btn-colmn">
            <div class="col-md-12 ">
                <a :href="`#${area}`"  data-toggle="collapse" aria-expanded="false" :aria-controls="area" class="btn btn-outline-light w-100 mb-3 keepchange-btn" v-on:click='changePackageSetting()'>Change Package Settings</a>
            </div>
            <div class="col-md-12">
                <a :href="`#${area}`" data-toggle="collapse" aria-expanded="false" :aria-controls="area" class="btn btn-outline-light w-100 keepchange-btn"  v-on:click='keepCurrentSetting()' >Keep Current Settings</a>
            </div>

            <p class="p-txt"> <span class="attention-icon"><img :src="`${ asset }/assets/images/icon_attention.svg`" alt=""></span>This will not change the preset settings </p>
        </div>

    </form>
</template>

<script>

    import * as methods from '../Common/helper';
    
    export default {
        name: 'PackageForm',
        props: ['form', 'area'],

        beforeMount() {
            this.asset = methods.asset();
        },

        data() {
            return {
                asset:'',
            }
        },

        methods: {
            keepCurrentSetting: function(){
                this.form.keep_current_setting = true;
                this.$emit("keepCurrentSetting", this.form);
            },

            changePackageSetting: function(){
                this.form.keep_current_setting = false;
                this.$emit("changePackageSetting", this.form);
            }
        },
    }
</script>


