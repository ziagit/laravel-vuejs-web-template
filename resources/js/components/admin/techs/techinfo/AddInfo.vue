<template>
    <div>
        <form>
            <md-card>
                <md-card-content>
                    <md-content class="md-layout">
                        <md-datepicker v-model="date" name="date"></md-datepicker>
                        <md-field class="md-layout-item">
                            <label>Number of users</label>
                            <md-input v-model="users" name="users"></md-input>
                        </md-field>
                        <md-field class="md-layout-item">
                            <label>Technology</label>
                            <md-select v-model="tech">
                                <md-option 
                                v-for="inf in info" 
                                :key="inf.id"
                                :value="inf.name">{{inf.name}}</md-option>
                            </md-select>
                        </md-field>
                    </md-content>
                </md-card-content>
                <md-card-actions>
                    <md-button @click="postData()">Submit</md-button>
                </md-card-actions>
            </md-card>
        </form>
    </div>
</template>

<script lang="ts">
import Vue from 'vue';
import Axios from 'axios';
import CONFIG from '../../../../config';
    export default Vue.extend({
        props:['info'],
        data: ()=>{
            return {
                date: '2020-01-01',
                users: '',
                tech: 'Angular',
                config: CONFIG
            }
        },
        methods:{
            postData(){
                Axios.post(this.config.baseUrl+'admin/techs-info',{
                    date: this.date,
                    users: this.users,
                    tech: this.tech
                }).then(res=>{
                    this.$emit('close-dialog');
                    console.log("saved: ", res);
                }).catch(err=>{
                    console.log("Error: ", err);
                })
            }
        },
        created(){
        }
    })
</script>

<style scoped>
.md-card{
    box-shadow:none;
}
</style>