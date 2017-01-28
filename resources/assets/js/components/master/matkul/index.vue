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
        <matkul-data v-for="lessonValue in lessons" :key="lessonValue.index" :lessons="lessonValue" @update-data="fetchData" @deleteMatkul="deleteData"keep-alive></matkul-data>
      
    </tbody>
  </table>
  <div>
   <div class="pagination">
            <button class="btn btn-default" @click="fetchData(pagination.prev_page_url)"
                    :disabled="!pagination.prev_page_url">
                Previous
            </button>
            <span>Page {{pagination.current_page}} of {{pagination.last_page}}</span>
            <button class="btn btn-default" @click="fetchData(pagination.next_page_url)"
                    :disabled="!pagination.next_page_url">Next
            </button>
        </div>
        </div>
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
            query:'',
            pagination:{}
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

                       axios.get(page_url).then(response=>{
                          console.log(response.data.lessons.data)
                          this.lessons = response.data.lessons.data;
                          //make pagination
                          //https://dotdev.co/simple-vue-js-pagination-with-laravel-33b7cfbb5ccc#.r91silp7d
                          this.makePagination(response.data.lessons);
                          console.log(this.lessons);
                      },response=>{
                          console.log(response.data);
                      })
                    }
               
            },
            addData(value){
              //unshift nambah array bagian pertama
              //push nambah array bagian pertama dan akhir, biasanya terakhir
                this.lessons.unshift(value)
                this.fetchData()
            },
            deleteData(value){
                axios.delete('api/lessons/'+value.id).then(response=>{
                    let index = this.lessons.indexOf(value);
                    this.lessons.splice(index,1);
                    alert(response.data.message);
                })
            },
            makePagination(response){
                let pagination = {
                    current_page: response.current_page,
                    last_page: response.last_page,
                    next_page_url: response.next_page_url,
                    prev_page_url: response.prev_page_url
                }
                this.pagination = pagination            }
       },watch:{
            query(value){
                if(value==''){
                  this.fetchData()
                }
            }
       }

    }

</script>