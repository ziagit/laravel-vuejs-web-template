<template>
    <div>
        <form>
            <md-card>
                <md-card-content>
                    <md-content class="md-layout">
                        <md-field class="md-layout-item">
                            <label>Name</label>
                            <md-input v-model="name" name="name"></md-input>
                        </md-field>
                        <md-field class="md-layout-item">
                            <label>Email</label>
                            <md-input v-model="email" name="email"></md-input>
                        </md-field>
                        <md-field class="md-layout-item md-large-size-100 md-small-size-100 md-xsmall-size-100">
                            <label>Message</label>
                            <md-textarea v-model="body" name="body"></md-textarea>
                        </md-field>
                    </md-content>
                </md-card-content>
                <md-card-actions>
                    <md-button v-on:click="editData()">Submit</md-button>
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
        props:['contactData'],
        data: ()=>{
            return {
                id:'',
                name:'',
                email:'',
                body:'',
                config: CONFIG
            }
        },
        methods:{
            editData(){
                Axios.post(this.config.baseUrl + 'admin/contact/update',{
                    id: this.id,
                    name: this.name,
                    email: this.email,
                    body: this.body
                }).then(res=>{
                    console.log("updated successfully! ", res.data);
                    this.$emit('close-dialog');
                }).catch(err=>{
                    console.log("Error: ", err)
                })
            },
        },
        mounted(){
            this.id = this.contactData.id;
            this.name = this.contactData.name;
            this.email = this.contactData.email;
            this.body = this.contactData.body;
        }
    })
</script>

<style scoped>
.md-card{
    box-shadow:none;
}
</style>