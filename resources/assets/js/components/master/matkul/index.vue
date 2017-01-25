<template>
<div>
   <add-matkul @add-data="addData"></add-matkul>
   <br>
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
            lessons:[]
        }
       },
       methods:{
            fetchData(){
                axios.get('api/lessons').then(response=>{
                    console.log(response.data)
                    this.lessons = response.data.lessons;
                    console.log(this.lessons);
                },response=>{
                    console.log(response.data);
                })
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
       }

    }

</script>