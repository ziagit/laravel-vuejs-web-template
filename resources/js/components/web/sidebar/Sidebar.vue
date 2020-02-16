<template>
  <div>
    <Projects />

    <LatestPost />
  </div>
</template>
<script>
import LatestPost from './LatestPost';
import Projects from '../projects/Projects';
import CONFIG from '../../../config';
export default {
  name: "SideBar",
  data: ()=>{
    return {
      config: CONFIG
    }
  },
  components: {
    Projects,
    LatestPost,
  }
};
</script>
<style lang="scss" scoped>
.md-card {
  margin-bottom: 5px;
  box-shadow: none;
  .md-list {
    color: #35495e;
    .router-link{
      color: #41b883;
    }
  }

}
</style>