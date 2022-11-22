<template>
    <form action="" class="form-layout-view-style">
        <div class="form-group">
            <input type="hidden" v-model="form.type" class="form-control">
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-lg-9 col-md-6">
                    <label for="titletxt" class="small-label">PACKAGE PRICE </label>
                    <input v-model='form.price' class="form-control" type="text"  placeholder="All prices in Dollars ($)">
                    <span class="mendetory-dot "><i class="icon-icon_form_required"></i></span>
                    <small class="error-text d-none">validation Error text</small>
                </div>
                <div class="col-lg-3 col-md-6">
                    <label for="titletxt" class="small-label">PER</label>
                    <input v-model='form.per_price' class="form-control" type="text"  placeholder="Per Price">
                    <span class="mendetory-dot"><i class="icon-icon_form_required"></i></span>
                    <small class="error-text d-none">validation Error text</small>
                    <small class="validation-info correct-icon d-none"> </small>
                </div>
            </div>

        </div>
        <div class="form-group">
            <label for="" class="small-label">PACKAGE OFFERS <i class="icon-icon_wallet"></i> </label>
            <input v-model='form.offer' class="form-control" type="text"  placeholder="No offers for this package">                                              
            <small class="error-text d-none">validation Error text</small>
            <small class="validation-info correct-icon d-none"></small>
        </div>
        <div class="form-group">
            <label for="description" class="small-label">PACKAGE DISCRIPTION
            </label>
            <textarea v-model='form.description' placeholder="Keep it brief… max. 200 characters" class="form-control cstm-text-area"></textarea>
            <span class="mendetory-dot"><i class="icon-icon_form_required"></i></span>
            <small class="error-text d-none">validation Error text</small>
        </div>

        <div class="form-group">
            <label for="includes" class="small-label">WHAT’S INCLUDED?</label>
            <textarea v-model='form.includes' placeholder="Example: Two initial design concepts" class="form-control cstm-text-area"></textarea>
            <span class="mendetory-dot"><i class="icon-icon_form_required"></i></span>
            <small class="error-text d-none">validation Error text</small>
        </div>

        <div class="form-group">
            <div class="btn-group-row d-flex">
                <button class="btn btn-outline-dark  mb-0 mb-md-3 mr-1 mr-lg-3 mr-md-3 " type="button" v-on:click='this.$emit("savedraft", form)'  :disabled="saveDisabled" ><span v-if="!loadingDraft">Save as draft</span><span v-else><i class="fas fa-spinner"></i> Save as draft</span></button>
                <button class="btn btn-dark mb-0 mb-md-3" type="button" v-on:click='this.$emit("saveform", form)' :disabled="saveDisabled"><span v-if="!loading">Proceed</span><span v-else><i class="fas fa-spinner"></i> Proceed</span></button>
            </div>
        </div>

    </form>
</template>

<script>
    export default {
        name: 'PackageForm',
        props: ['form', 'loading', 'loadingDraft', 'saveDisabled'],
    }
</script>

