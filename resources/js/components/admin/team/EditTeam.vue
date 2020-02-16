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
                            <label>Image</label>
                            <md-file name="image" accept="image/*" v-on:change="imageOnChange" />
                        </md-field>
                        <md-field class="md-layout-item md-large-size-100 md-small-size-100 md-xsmall-size-100">
                            <label>position</label>
                            <md-input v-model="position" name="position"></md-input>
                        </md-field>
                        <md-field class="md-layout-item md-large-size-100 md-small-size-100 md-xsmall-size-100">
                            <label>Details</label>
                            <md-textarea v-model="details" name="details"></md-textarea>
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
        props:['teamData'],
        data: ()=>{
            return {
                id:'',
                name:'',
                image:'',
                details: '',
                position: '',
                config: CONFIG
            }
        },
        methods:{
            imageOnChange(e){
                this.image = e.target.files[0];
            },
            editData(){
                let fd = new FormData();
                fd.append("id",this.id);
                fd.append("image",this.image);
                fd.append('name', this.name);
                fd.append('details', this.details);
                fd.append('position', this.position);
                Axios.post(this.config.baseUrl + 'admin/team/update',fd).then(res=>{
                    console.log("updated successfully! ", res.data);
                    this.$emit('close-dialog');
                }).catch(err=>{
                    console.log("Error: ", err)
                })
            },
        },
        mounted(){
            this.id = this.teamData.id;
            this.name = this.teamData.name;
            this.details = this.teamData.details;
            this.position = this.teamData.position;
        }
    })
</script>

<style scoped>
.md-card{
    box-shadow:none;
}
</style>