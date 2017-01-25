<template>
	<div>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Tambah Matkul</button>

		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="exampleModalLabel">Tambah Matakuliah</h4>
					</div>
					<div class="modal-body">
						<form>
							<div  v-bind:class="{'form-group': true, 'has-error': errors.lesson_name}">
								<label for="message-text" class="control-label">Matakuliah:</label>
								<textarea class="form-control" id="message-text" name="lesson_name" v-model="lessons.lesson_name"></textarea>
								<span class="help-block" style="color:red" v-for="error in errors.lesson_name">{{error}}</span>
								
							</div>
						</form>
					</di>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" @click.prevent="addData">Tambah</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	import axios from 'Axios'
	export default {
		data(){
			return {

					lessons:{
								lesson_name:''
					},
					errors:[]
			}
		},
		methods:{
				addData(){
					axios.post('api/lesson',this.lessons).then(response=>{
							if(this.errors){
                            this.errors=[]
                       	 }
							this.lessons.lesson_name=''
							$('#exampleModal').modal('hide');
							console.log(response.data);
							this.$emit('add-data',response.data.lessons)
					}).catch(error=>{
						//http://stackoverflow.com/questions/38798451/how-to-catch-and-handle-error-422-response-redux-axios
						this.errors = error.response.data
					})
				}
		}
	}
</script>