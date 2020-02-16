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
                    initialValue=""
                    :init="config"
                    ></editor>

                    </md-content>
                </md-card-content>
                <md-card-actions>
                    <md-button v-on:click="postData()">Submit</md-button>
                </md-card-actions>
            </md-card>
        </form>
    </div>

</template>

<script>
import Axios from 'axios';
import Editor from '@tinymce/tinymce-vue';
export default {
    name: 'AddPost',
    data: () => {
      return {
        title: '',
        subtitle: '',
        body: '',
        image: '',
        config:{
          height: 300,
          width: '100%',
          menubar: false,
          plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars codesample fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern',
            'table emoticons autoresize'
          ],
          toolbar:
          `insertfile | styleselect | bold italic | alignleft aligncenter alignright alignjustify
           | bullist numlist outdent indent | link image media codesample table emoticons textcolor`,
        }
      }
        
    },
    methods: {
      imageOnChange(e){
          this.image = e.target.files[0];
      },
      postData(){
          let fd = new FormData();
          fd.append("image",this.image);
          fd.append('title',this.title);
          fd.append('subtitle', this.subtitle);
          fd.append('body', this.body);
          Axios.post('http://localhost:8000/api/admin/post',fd).then(res=>{
              console.log("saved successfully! ", res.data);
              this.$emit('close-dialog');
          }).catch(err=>{
              console.log("Error: ", err)
          })
      },
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