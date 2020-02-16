<template>
  <div class="page-container">
    <md-app>
      <md-app-toolbar class="md-primary color-default" md-elevation="0">
        <md-button class="md-icon-button" @click="toggleMenu" v-if="!menuVisible">
          <md-icon>menu</md-icon>
        </md-button>
        <span class="md-title">Monkey Class</span>
      </md-app-toolbar>

      <md-app-drawer :md-active.sync="menuVisible" md-persistent="mini">
        <md-toolbar class="md-transparent" md-elevation="0">
          <span>Navigation</span>

          <div class="md-toolbar-section-end">
            <md-button class="md-icon-button md-dense" @click="toggleMenu">
              <md-icon>keyboard_arrow_left</md-icon>
            </md-button>
          </div>
        </md-toolbar>

        <md-list>
          <router-link v-for="item in menuitems" v-bind:key="item.id" :to="`/admin/${item.path}`">
            <md-list-item>
              <md-icon>{{item.icon}}</md-icon>
              <span class="md-list-item-text">{{item.title}}</span>
            </md-list-item>
          </router-link>
        </md-list>

      </md-app-drawer>

      <md-app-content>
        <router-view></router-view>
      </md-app-content>
    </md-app>
  </div>
</template>

<script>
import Axios from 'axios';
export default {
  name: "Admin",
  data: () => ({
    menuVisible: false,
    menuitems:[
      {id: "1", title: "Dashboard", icon: "dashboard", path: ""},
      {id: "2", title: "Posts", icon: "post_add", path: "posts"},
      {id: "3", title: "Projects", icon: "widgets", path: "projects"},
      {id: "4", title: "Technologies", icon: "widgets", path: "techs"},
      {id: "5", title: "Tech Info", icon: "info", path: "techs-info"},
      {id: "6", title: "Company", icon: "business", path: "company"},
      {id: "7", title: "Team", icon: "person", path: "team"},
      {id: "8", title: "Contact", icon: "contact_mail", path: "contact"},
    ]
  }),
  methods: {
    toggleMenu () {
      this.menuVisible = !this.menuVisible
    }
  }

}
</script>

<style lang="scss" scoped>
.md-app-content{
  height: 536px !important;
}
  .color-default{
      background: linear-gradient(110deg, #41b883 90%, rgb(30, 110, 74) 10%);
  }
  .md-app {
    min-height: 350px;
    border: 1px solid rgba(#000, .12);
  }
  .md-drawer {
    width: 230px;
    max-width: calc(100vw - 125px);
  }

</style>