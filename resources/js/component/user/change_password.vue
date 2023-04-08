<template lang="">
<div class="col-xl-9 col-lg-8 col-md-12 m-b30">

    <!--Filter Short By-->
    <div class="twm-right-section-panel site-bg-gray">
        <div class="panel panel-default">
            <div class="panel-heading wt-panel-heading p-a20">
                <h4 class="panel-tittle m-a0">Change Password</h4>
            </div>
            <div class="panel-body wt-panel-body p-a20 ">

                    <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Old Password</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control wt-form-control" v-model="model.old_password" type="password" placeholder="" required>
                                        <i class="fs-input-icon fa fa-asterisk "></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control wt-form-control" v-model="model.new_password" type="password" placeholder="" required>
                                        <i class="fs-input-icon fa fa-asterisk"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>Confirm New Password</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control wt-form-control" v-model="model.confirm_password" type="password" placeholder="" required>
                                        <i class="fs-input-icon fa fa-asterisk"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="text-left">
                                    <button type="submit" @click.prevent="submit()" class="site-button">Save Changes</button>
                                </div>
                            </div>

                    </div>

            </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    props:{

    },
    data() {
        return {
            model:{
                'old_password':'',
                'new_password':'',
                'confirm_password':''
            },
            // formSubmitted: false
        }
    },
    methods: {
        submit(){
            if (this.model.new_password !== this.model.confirm_password) {
                toast.error("პაროლი არ ემთხვევა!", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                return
            }else if(!this.model.new_password || !this.model.confirm_password || !this.model.old_password){
                toast.error("შევსება სავალდებულოა!", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                return
            }else if(this.model.new_password.length < 8){
                toast.error("პაროლი უნდა შედგებოდეს 8 სიმბოლოსგან!", {
                    theme: 'colored',
                    autoClose: 1000,
                });
                return
            }
            let currentObj = this
            axios({
                method: "post",
                url: "/change_password",
                data: this.model,
            })
            .then(function (response) {
                // handle success
                if (response.status == 200) {
                    currentObj.model = {
                        'old_password':'',
                        'new_password':'',
                        'confirm_password':''
                    }
                    if (response.data.type == 's') {
                        toast.success(response.data.message, {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                    } else {
                        toast.error(response.data.message, {
                            theme: 'colored',
                            autoClose: 1000,
                        });
                    }

                }
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        }
    },
}
</script>
<style lang="">

</style>
