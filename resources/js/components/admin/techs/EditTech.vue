<template>
    <div>
        <form>
            <md-card>
                <md-card-content>
                    <md-content class="md-layout">
                        <md-field class="md-layout-item">
                            <label>Name</label>
                            <md-input v-model="tech.name"></md-input>
                        </md-field>
                        <md-field class="md-layout-item">
                            <label>Brand Color</label>
                            <md-input v-model="tech.brand"></md-input>
                        </md-field>
                        <md-field class="md-layout-item">
                            <label>Logo</label>
                            <md-file name="logo" accept="image/*" v-on:change="logoOnChange($event)" /> 
                        </md-field>
                        <md-field class="md-layout-item md-large-size-100 md-small-size-100 md-xsmall-size-100">
                            <label>details</label>
                            <md-textarea v-model="tech.details"></md-textarea>
                        </md-field>
                    </md-content>
                </md-card-content>
                <md-card-actions>
                    <md-button @click="editTech()">Submit</md-button>
                </md-card-actions>
            </md-card>
        </form>
    </div>
</template>

<script>
import Axios from 'axios';
import Editor from '@tinymce/tinymce-vue';
import CONFIG from '../../../config';
export default {
    name: 'editTech',
    props:['techData'],
    data: () => {
        return {
            tech:{
                id: '',
                name:'',
                brand: '',
                logo:'',
                details: '',
            },
            config: CONFIG
            }
    },
    methods: {
      logoOnChange(e){
          this.tech.logo = e.target.files[0];
      },
      editTech(){
            let fd = new FormData();
            fd.append('id', this.tech.id);
            fd.append('logo', this.tech.logo);
            fd.append('name', this.tech.name);
            fd.append('brand', this.tech.brand);
            fd.append('details', this.tech.details);
            Axios.post(this.config.baseUrl+'admin/techs/update',fd).then(res=>{
                console.log("updated successfully! ", res.data);
                this.$emit('close-dialog');
            }).catch(err=>{
                console.log("Error: ", err)
            })
      },
    },
    mounted(){
        this.tech.id= this.techData.id;
        this.tech.name= this.techData.name;
        this.tech.brand= this.techData.brand;
        this.tech.details= this.techData.details;
    },
    components: {
    },
}
</script>
<style scoped>
.md-card{
  box-shadow:none;
}
</style>