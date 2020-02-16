<template>
  <div class="container">
    <md-snackbar :md-position="position" :md-duration="isInfinity ? Infinity : duration" :md-active.sync="showSnackbar" md-persistent>
      <span>Your message sent successfully!</span>
      <md-button class="md-primary" @click="showSnackbar = false"><md-icon class="snake-icon">close</md-icon></md-button>
    </md-snackbar>
    <md-card>
      <div class="md-layout">
        <div class="md-layout-item">
          <md-card-header>
            <md-card-header-text>
              <h3 class="md-title">Find Us on Map</h3>
            </md-card-header-text>
          </md-card-header>
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3287.427935478633!2d69.13373451461577!3d34.51738450052287!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38d16f2c550c3f59%3A0xa47b5d537e5b7214!2sKabul%20University!5e0!3m2!1sen!2s!4v1575880527726!5m2!1sen!2s"
            width="600"
            height="450"
            frameborder="0"
            style="border:0;"
            allowfullscreen
          ></iframe>
          <md-speed-dial md-direction="bottom">
            <md-speed-dial-target>
              <md-icon>contact_support</md-icon>
            </md-speed-dial-target>

            <md-speed-dial-content>
              <md-button class="md-icon-button">
                <md-icon>phone</md-icon>
              </md-button>

              <md-button class="md-icon-button">
                <md-icon>mail</md-icon>
              </md-button>
              <md-button class="md-icon-button">
                <md-icon>F</md-icon>
              </md-button>
              <md-button class="md-icon-button">
                <md-icon>Y</md-icon>
              </md-button>
            </md-speed-dial-content>
          </md-speed-dial>
        </div>
        <div class="md-layout-item md-size-35 md-xsmall-size-100">
          <md-card-header>
            <md-card-header-text>
              <h3 class="md-title">Send Us an Email</h3>
            </md-card-header-text>
          </md-card-header>
          <form>
          <md-card-content>
            <md-content>
              <md-field>
                <label>Name</label>
                <md-input v-model="name" name="name" required></md-input>
              </md-field>

              <md-field>
                <label>Email</label>
                <md-input v-model="email" name="email" required></md-input>
              </md-field>

              <md-field>
                <label>Your Message</label>
                <md-textarea v-model="message" name="message" md-autogrow required></md-textarea>
              </md-field>
            </md-content>
          </md-card-content>
          <md-card-actions>
            <md-button @click="sendMessage()" class="sendMsg" md-toollbar="Hi.">Submit</md-button>
          </md-card-actions>
          </form>
        </div>
      </div>
    </md-card>
  </div>
</template>
<script>
import Axios from 'axios';
import CONFIG from '../../config';
export default {
  name: "Contact",
  data: () => {
    return{
      title: 'Contact Monkey Class',
      name: '',
      email: '',
      message: '',
      position: 'center',
      duration: 4000,
      showSnackbar: false,
      isInfinity: false,
      config: CONFIG
    }
  },
  methods:{
    sendMessage(){
      Axios.post(this.config.baseUrl + 'contact',{
        name: this.name,
        email: this.email,
        message: this.message
      }).then(res=>{
          this.success=true;
          this.name=''
          this.email=''
          this.message=''
          this.showSnackbar = true;
      }).catch(err=>{
          console.log("Error: ", err)
      })
    }
  },
  created(){
    document.title = this.title;
  }
};
</script>
<style lang="scss" scoped>
.md-card {
  color: #35495e !important;
  padding: 20px;
  margin-top: -20px;
  /* height: calc(100vh - 126px); */
  iframe{
    min-height:230px !important;
  }
  .md-speed-dial{
    flex-direction: row !important;
    .md-speed-dial-content{
      flex-direction: row !important;
      .md-button {
        color: #35495e !important;
      }
      .md-button:hover {
        background: #41b883;
      }
    }
    .md-speed-dial-target{
      background: #35495e !important;
    }
    .md-speed-dial-target:hover {
      background: #41b883 !important;
    }
  }
  .snake-icon{
    color: #41b883 !important;
  }
  .md-primary{
    margin-top:10px;
    background:#41b883;
  }
  .md-primary:hover{
    background:#35495e !important;
  }
  .phone{
      font-size:20px;
  }
 .sendMsg:hover{
   background: #41b883 !important;
   color: #fff !important;
 }
}
</style>