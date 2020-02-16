<template>
    <div>
        <form>
            <md-card>
                <md-card-content>
                    <md-content class="md-layout">
                        <md-field class="md-layout-item md-large-size-100 md-small-size-100 md-xsmall-size-100">
                            <label>Name</label>
                            <md-input v-model="name" name="name"></md-input>
                        </md-field>
                        <md-field class="md-layout-item">
                            <label>Logo</label>
                            <md-file name="logo" accept="image/*" v-on:change="logoOnChange" />
                        </md-field>
                        <md-field class="md-layout-item">
                            <label>Slide</label>
                            <md-file name="slide" accept="image/*" v-on:change="slideOnChange"/>
                        </md-field>
                        <md-field class="md-layout-item md-large-size-100 md-small-size-100 md-xsmall-size-100">
                            <label>Slogan</label>
                            <md-textarea v-model="slogan" name="slogan"></md-textarea>
                        </md-field>
                    
                        <md-field class="md-layout-item md-large-size-100 md-small-size-100 md-xsmall-size-100">
                            <label>Details</label>
                            <md-textarea v-model="details" name="details"></md-textarea>
                        </md-field>
                    </md-content>
                </md-card-content>
                <md-card-actions>
                    <md-button v-on:click="postData()">Submit</md-button>
                </md-card-actions>
            </md-card>
        </form>
    </div>
</template>

<script lang="ts">
import CONFIG from '../../../config';
import Vue from 'vue';
import Axios from 'axios';
export default Vue.extend({
    data: ()=>{
        return {
            name: '',
            logo:'',
            slide:'',  
            details: '',
            slogan: '',
            config: CONFIG
        }
    },
    methods:{
        logoOnChange(e){
            this.logo = e.target.files[0];
        },
        slideOnChange(e){
            this.slide = e.target.files[0];
        },
        postData(){
            let fd = new FormData();
            fd.append("name",this.name);
            fd.append("logo",this.logo);
            fd.append('slide',this.slide);
            fd.append('details', this.details);
            fd.append('slogan', this.slogan);

            Axios.post(this.config.baseUrl + 'admin/company',fd).then(res=>{
                console.log("saved successfully! ", res.data);
                this.$emit('close-dialog');
            }).catch(err=>{
                console.log("Error: ", err)
            })
        },
    }
})
</script>

<style scoped>
.md-card{
    box-shadow:none;
}
</style>