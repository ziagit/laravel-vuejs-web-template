<template>
    <div>
        <form>
            <md-card>
                <md-card-content>
                    <md-content class="md-layout">
                        <md-field class="md-layout-item">
                            <label>Title</label>
                            <md-input v-model="title" name="title"></md-input>
                        </md-field>
                        <md-field class="md-layout-item">
                            <label>Subtitle</label>
                            <md-input v-model="subtitle" name="subtitle"></md-input>
                        </md-field>
                        <md-field class="md-layout-item">
                            <label>Image</label>
                            <md-file name="image" accept="image/*" v-on:change="imageOnChange($event)" />
                        </md-field>
                  <editor
                    v-model="body"
                    api-key="no-api-key"
                    initialValue=""
                    :init="config"
                    ></editor>

                    </md-content>
                </md-card-content>
                <md-card-actions>
                    <md-button v-on:click="editProject()">Submit</md-button>
                </md-card-actions>
            </md-card>
        </form>
    </div>

</template>

<script>
import Axios from 'axios';
import Editor from '@tinymce/tinymce-vue';
export default {
    name: 'EditProject',
    props:['projectData'],
    data: () => {
      return {
        id: '',
        title: '',
        subtitle: '',
        body: '',
        image: '',
        config: {
            height: 300,
            width: '100%',
            menubar: false,
            plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars codesample fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern',
            'table emoticons'
                ],
            toolbar:
            `insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright 
            alignjustify | bullist numlist outdent indent | link image media codesample table emoticons`,
        }
      }
    },
    methods: {
      imageOnChange(e){
          this.image = e.target.files[0];
      },
      editProject(){
        console.log("body: ", this.body)
          let fd = new FormData();
          fd.append('id', this.id);
          fd.append("image",this.image);
          fd.append('title',this.title);
          fd.append('subtitle', this.subtitle);
          fd.append('body', this.body);
          Axios.post('http://localhost:8000/api/admin/project/update',fd).then(res=>{
              console.log("updated successfully! ", res.data);
              this.$emit('close-dialog');
          }).catch(err=>{
              console.log("Error: ", err)
          })
      },
    },
    mounted(){
        this.id= this.projectData.id;
        this.title= this.projectData.title;
        this.subtitle= this.projectData.subtitle;
        this.body= this.projectData.body;
    },
    components: {
      'editor': Editor
  },
}
</script>
<style scoped>
.md-card{
  box-shadow:none;
}
</style>