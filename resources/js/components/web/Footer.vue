<template>
  <div>
    <md-card>
      <md-snackbar :md-position="position" :md-duration="isInfinity ? Infinity : duration" :md-active.sync="showSnackbar" md-persistent>
      <span>Thank you for subscribing us !!!</span>
      <md-button class="md-primary" @click="showSnackbar = false"><md-icon class="snake-icon">close</md-icon></md-button>
    </md-snackbar>
      <div class="md-layout md-alignment-center">
        <div class="md-layout-item md-xlarge-size-33 md-large-size-33 md-medium-size-33 md-small-size-33 md-xsmall-size-100">
          <form>
              <md-field>
                <label>Your Email</label>
                <md-input v-model="email" name="email" required></md-input>
              </md-field>
              <md-button @click="subscribe()">Subscribe</md-button>
          </form>
        </div>
      </div>
      <div class="md-layout md-alignment-center">
        <div class="md-layout-item md-medium-size-33 md-small-size-33 md-xsmall-size-100">
          <md-list class="md-double-line md-dense">
            <md-subheader>
              <Directions class="icon" />
              <h3>Note:</h3>
            </md-subheader>
                <p class="note">{{note}}</p>
          </md-list>
        </div>
        <div class="md-layout-item md-medium-size-33 md-small-size-33 md-xsmall-size-100">
          <md-list class="md-double-line md-dense">
            <md-subheader>
              <Folder class="icon" />
              <h3>Top Courses We Provide</h3>
            </md-subheader>
              <router-link v-for="course in courses" :key="course.id" to="/not-found">
                <h4 class="md-subheading">{{course.title}}</h4>
              </router-link>
          </md-list>
        </div>
        <div class="md-layout-item md-medium-size-33 md-small-size-33 md-xsmall-size-100">
          <md-list class="md-double-line md-dense">
            <md-subheader>
              <Apps class="icon" />
              <h3>Free Open Source Apps</h3>
            </md-subheader>
              <router-link v-for="app in apps" :key="app.id" to="/not-found">
                <h4 class="md-subheading">{{app.title}}</h4>
              </router-link>
          </md-list>
        </div>
      </div>
    </md-card>
  </div>
</template>
<script>
import Directions from "vue-material-design-icons/Directions.vue";
import Phone from "vue-material-design-icons/Phone.vue";
import Mail from "vue-material-design-icons/Mail.vue";
import Folder from "vue-material-design-icons/Folder.vue";
import Apps from "vue-material-design-icons/Apps.vue";
import Axios from 'axios';
import CONFIG from '../../config';

export default {
  name: "Footer",
  data: ()=>{
    return {
      duration: 4000,
      showSnackbar: false,
      isInfinity: false,
      position: 'center',
      config: CONFIG,
      email: '',
      note:'We link and guide througth implementation of some third party products via affiliate or sponsored links.',
      courses: [
        {id: 1, title: 'Vuejs v3', body: 'Vuejs v3'},
        {id: 2, title: 'Angular v9', body: 'Angular v9'},
        {id: 3, title: 'Ionic v4', body: 'Ionic v4'},
        {id: 4, title: 'Laravel v6', body: 'Laravel v6'},
      ],
      apps: [
        {id: 1, title: 'ERPNext', body: 'ERPNext'},
      ]
    }
  },
  methods:{
    subscribe(){
        Axios.post(this.config.baseUrl + 'contact',{
          name: this.email,
          email: this.email,
          message: this.email
      }).then(res=>{
          this.showSnackbar = true;
          this.email=''
      }).catch(err=>{
          console.log("Error: ", err)
      })
    }
  },
  components: {
    Directions,
    Phone,
    Mail,
    Folder,
    Apps
  }
};
</script>
<style lang="scss" scoped>
.md-card {
  width: 100%;
  background: #35495e;
  box-shadow: none;
  padding: 30px;
  border-radius: 0;
  color: #fff;
  form{
    display:flex;
    .md-field{
      margin: -12px 0 26px !important;
      color:#ccc !important;
      label{
        color: #ccc !important;
      }
    }
    .md-button{
      color:#ccc !important;
    }
  }
  .md-list{
    background:none;
  }
  .icon{
    color:#ccc;
    font-size: 30px;
    line-height: 23px;
    height: 0.5em;
    margin:10px;
    width:1.2em;
  }
  .md-subheading{
    color:#1473e6;
    font-size: 14px;
    line-height: 24px;
    margin-left:30px;
  }
  .note{
    margin-left:30px;
    color:#ccc;
  }
  
  h3{
    color:#ccc;
    font-size: 18px;
    line-height: 23px;
  }
  .md-layout{
    align-items:start !important;
  }
}
</style>