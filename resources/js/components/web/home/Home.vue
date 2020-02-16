<template>
  <div class="container">
    <md-card>
      <md-card-header><h3>Web Frameworks Comparison Chart</h3></md-card-header>
      <div>
        <line-chart 
        :data="data" 
        :colors="['#FF3042', '#41B883', '#24ACF2']"
        xtitle="Years" ytitle="Number of Contributors on GitHub"
        :precision="6"
        />
      </div>
<br>
      <md-card-header><h3>Mobile Frameworks Comparison Chart</h3></md-card-header>
      <vc-donut
        background="white" foreground="grey"
        :size="300" unit="px" :thickness="30"
        hasLegend legendPlacement="top"
        :sections="sections" :total="100"
      >
      <h1>100%</h1>
      </vc-donut>

    </md-card>
  </div>
</template>
<script>
import Axios from 'axios';
import CONFIG from '../../../config';
export default {
  name: "Home",
   data: ()=> {
      return {
        title: 'Monkey Class Home Page',
        sections: [
          { label: 'Ionic', value: 25, color: '#24ACF2' },
          { label: 'React Native', value: 30, color: '#41B883' },
          { label: 'Native', value: 35, color: '#FF3042' }
        ],
        data : [
          {
            name: 'Angular', 
            data: {
              '2010-01-01': 0,
              '2011-01-01': 0,
              '2012-01-01': 5,
              '2013-01-01': 10,
              '2014-01-01': 50,
              '2015-01-01': 100,
              '2016-01-01': 85,
              '2017-01-01': 90,
              '2018-01-01': 80,
              '2019-01-01': 90,
            }
          },
          {
            name: 'Vuejs', 
            data: {
              '2014-01-01': 0,
              '2015-01-01': 4,
              '2016-01-01': 50,
              '2017-01-01': 45,
              '2018-01-01': 40,
              '2019-01-01': 40
            }
          },
          {
            name: 'Reactjs', 
            data: {
              '2011-01-01': 0,
              '2012-01-01': 0,
              '2013-01-01': 5,
              '2014-01-01': 15,
              '2015-01-01': 15,
              '2016-01-01': 20,
              '2017-01-01': 10,
              '2018-01-01': 50,
              '2019-01-01': 50
            }
          }
        ],
        config: CONFIG,
        xdata:[
          {
            name: '',
            xdata: {date:''}
          }
        ],
      }
    },
    methods:{
      getData(){
        Axios.get(this.config.baseUrl + 'techs').then(res=>{
          this.calc(res.data);
        })
      },
      calc(techs){
        for (let i = 0; i < techs.length; i++) {
    
        }
      }
    },
    created(){
      this.getData();
      document.title = this.title;
      this.calc();
    }
}
</script>
<style lang="scss" scoped>
  .md-card {
    text-align: left;
    color: #35495e !important;
    margin-top: -20px;
    padding: 20px;
    h3{
      text-align: center;
    }
  }
</style>