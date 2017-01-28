<template>
	<tr>
        <td>
			<input type="text" v-model="dataEdit.lesson_name" v-if="edit" class="form-control">
			<span v-else>
				{{lessons.lesson_name}}
			</span>
        </td>
        <td>
        	<button class="btn btn-primary" @click.prevent="editMatkul" v-if="!edit">Edit</button>
        	<button class="btn btn-default" @click.prevent="cancelEdit" v-if="edit">Cancel</button>
        	<button class="btn btn-success" @click.prevent="updateMatkul(lessons,dataEdit)" v-if="edit">Update</button>
			<button class="btn btn-danger" @click.prevent="deleteMatkul(lessons)" v-if="!edit">Delete</button>

        </td>
      </tr>
</template>
<script>
	import axios from 'Axios'
	export default {
		props:['lessons'],
		data(){
			return {
				edit:false,
				dataEdit:{
						lesson_name:''
				}
			}
		},
		methods:{
			editMatkul(){
					this.edit=true;
					this.dataEdit.lesson_name = this.lessons.lesson_name
			},
			cancelEdit(){
					this.edit=false;

			},
			updateMatkul(old,newValue){
				 axios.put('api/lesson/'+old.id,newValue).then(response=>{
					console.log(returnsponse.data)
					this.$emit('update-data')
					this.cancelEdit();
				},response=>{
					console.log(response)
				})
			},
			deleteMatkul(lessons){
				console.log('masuk')
				this.$emit('deleteMatkul',lessons)
			}
		}
	}
</script>