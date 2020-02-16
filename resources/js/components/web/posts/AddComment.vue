<template>
    <div>
        <form>
            <md-card>
                <md-card-content>
                    <md-content class="md-layout">
                        <md-field class="md-layout-item md-large-size-100 md-small-size-100 md-xsmall-size-100">
                            <label>Name</label>
                            <md-input v-model="name" name="name" />
                        </md-field>
                            <editor
                            v-model="comment"
                            initialValue=""
                            :init="configs"
                            ></editor>
                    </md-content>
                </md-card-content>
                <md-card-actions>
                    <md-button v-on:click="postComment()">Submit</md-button>
                </md-card-actions>
            </md-card>
        </form>
    </div>
</template>

<script lang="ts">
import CONFIG from '../../../config';
import Vue from 'vue';
import Axios from 'axios';
import Editor from '@tinymce/tinymce-vue';
export default Vue.extend({
    props:['pId'],
    data: ()=>{
        return {
            id: '',
            name:'',
            comment: '',
            config: CONFIG,
            configs:{
                height: 300,
                width: '100%',
                menubar: false,
                plugins: [
                    'advlist autolink lists link charmap preview hr anchor pagebreak',
                    'searchreplace visualblocks visualchars codesample fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern',
                    'autoresize'
                ],
                toolbar:
                `styleselect | bold italic |    
                | bullist | link codesample`,
            }
        }
    },
    methods:{
        postComment(){
            console.log("Post id isnide comemnet com: ", this.pId)
            Axios.post(this.config.baseUrl + 'add-comment',{
                postId: this.pId,
                name:this.name,
                comment: this.comment
            }).then(res=>{
                console.log("saved successfully! ", res.data);
                this.$emit('close-dialog');
            }).catch(err=>{
                console.log("Error: ", err)
            })
        },
    },
    created(){
        console.log("post id: ", this.pId)
    },
    components: {
      'editor': Editor
    },
})
</script>

<style scoped>
.md-card{
    box-shadow:none;
}
</style>