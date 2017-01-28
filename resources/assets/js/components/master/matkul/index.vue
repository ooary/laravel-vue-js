<template>
<div>
   <add-matkul @add-data="addData"></add-matkul>
   <br>
   <input type="text" v-model="query" class="form-control"> <br>
   <button class="btn btn-warning" v-if="!loading" @click.prevent="fetchData(query)">Search</button>
   <button class="btn btn-warning" v-if="loading" disabled="disabled">Search...</button>


   <hr>
     <table class="table table-bordered">
    <thead>
      <tr>
        <th>Nama Matkul</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        <matkul-data v-for="lessonValue in lessons" :lessons="lessonValue" @update-data="fetchData" @deleteMatkul="deleteData"keep-alive></matkul-data>
      
    </tbody>
  </table>
  
</div>
  
</template>

<script>
  import listMatkul from './matkulData.vue';
  import add from './addMatkul.vue';
  import axios from 'Axios';
    export default{
        created(){
            this.fetchData();
        },
       components:{
              'matkulData':listMatkul,
              'addMatkul':add
       },
       data(){
        return {
            lesson:{
                lesson_name:''
            },
            lessons:[],
            loading:false,
            query:''
        }
       },
       methods:{
            fetchData(page_url){
              console.log(page_url)
              page_url = page_url || '/api/lessons'
              if(this.query !=''){
                this.loading = true
                  console.log(this.query)

                  axios.get('api/lessons?query='+this.query).then(response=>{
                      console.log(response.data)
                      this.lessons = response.data.lessons;
                      console.log(this.lessons);
                      if(response.data.lessons== ''){
                          alert(this.query + ' Tidak di Temukan')
                        }
                      this.loading=false
                  },response=>{

                      console.log(response.data);
                  })
              }else{

                 axios.get('api/lessons/').then(response=>{
                    console.log(response.data.lessons.data)
                    this.lessons = response.data.lessons.data;
                    console.log(this.lessons);
                },response=>{
                    console.log(response.data);
                })
              }
               
            },
            addData(value){
                this.lessons.push(value)
            },
            deleteData(value){
                axios.delete('api/lessons/'+value.id).then(response=>{
                    let index = this.lessons.indexOf(value);
                    this.lessons.splice(index,1);
                    alert(response.data.message);
                })
            }
       },watch:{
            query(value){
                if(value==''){
                  this.fetchData()
                }
            }
       }

    }

</script>