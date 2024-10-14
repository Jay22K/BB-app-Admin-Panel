<template>
            <div class="row">
                <div class="row">
                <div class="col-6">
                    <div>
                        <p class="text-dark">Name</p>

                    </div>
                </div>
                <div class="col-6">
                    <div>
                        <p >{{user.name}}</p>
                        
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-6">
                    <div>
                        <p class="text-dark">ID</p>
                    </div>
                </div>
                <div class="col-6">
                        <p>{{user.id}}</p>
                </div>
                </div>
                <div class="row">
                <div class="col-6">
                    <div>
                        <p class="text-dark">Email</p>
                    </div>
                </div>
                <div class="col-6">
                    <div>
                        <p >{{user.email}}</p>
                        
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-6">
                    <div>
                        <p class="text-dark">Referral Code</p>
                    </div>
                </div>
                <div class="col-6">
                        <p>{{user.referral_code}}</p>
                </div>
                </div>
                <div class="row">
                <div class="col-6">
                    <div>
                        <p class="text-dark">Mobile No</p>
                    </div>
                </div>
                <div class="col-6">
                        <p>{{user.mobile}}</p>
                </div>
                </div>
                <div class="row">
                <div class="col-6">
                    <div>
                        <p class="text-dark">Country Code</p>
                    </div>
                </div>
                <div class="col-6">
                    <div>
                        <p >{{user.country_code}}</p>
                        
                    </div>
                </div>
                </div>
                <div class="row" v-if="image_url">
                        <div class="col-md-6 ">
                            <img class="custom-slider-image img-thumbnail" :src="image_url"/>
                        </div>
                </div>
            </div>
</template>

<script>
// import axios from 'axios';

export default {
    props: ['user','image'],
    data: function () {
        return {
            isLoading: false,
            image_url: this.image ? this.image: "" ,
            user:this.user ? this.user:"",
            error: null,
        };
    },
    computed: {
        modal_title: function () {
            let title = this.id ? __('edit_brand') : __('image');
            return title;
        },
    },
    created: function () {
        console.log("user2",this.user);
    },
    methods: {
        showModal() {
            this.$refs['my-modal'].show()
        },
        hideModal() {
            this.$refs['my-modal'].hide()
        },
        
    },
    mounted() {
        this.showModal();
    }
}
</script>

<style scoped>

.image_preview {
    margin-top: 5px;
}
img{
    width: 100%;
    height: auto;
}
</style>
