<template>
    <div class="d-flex justify-content-center">
        <div class="col-md-6 col-sm-6 col-lg-3">
            <div class="authentication-wrapper authentication-basic container-p-y">
                <div class="authentication-inner">
                    <!-- Register -->
                    <div class="card">
                        <div class="card-body warnjai-regular">
                            <!-- Logo -->
                            <div class="app-brand justify-content-center">
                                <span
                                    class="app-brand-text demo text-body warnjai-regular fw-bolder mb-3 mt-3">ລົງທະບຽນ</span>
                            </div>
                            <!-- /Logo -->
                            <div class="mb-3">
                                <label for="name" class="form-label">ຊື່ຜູ້ໃຊ້</label>
                                <input v-model="name" type="text" class="form-control" id="email" name="email-username"
                                    placeholder="ປ້ອນຊື່ຜູ້ໃຊ້..." autofocus="">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">ອີເມວ</label>
                                <input v-model="email" type="text" class="form-control" id="email" name="email-username"
                                    placeholder="ປ້ອນອີເມວ..." autofocus="">
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">ລະຫັດຜ່ານ</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input v-model="password" type="password" id="password" class="form-control"
                                        name="password" placeholder="ປ້ອນລະຫັດຜ່ານ..." aria-describedby="password">
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">ຢືນຢັນລະຫັດຜ່ານ</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input v-model="confirm_password" type="password" id="password" class="form-control"
                                        name="password" placeholder="ປ້ອນຢືນຢັນລະຫັດຜ່ານ..." aria-describedby="password">
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="alert alert-danger" role="alert" v-if="show_error">
                                {{ error_mgs }}
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit" @click="register()"
                                    :disabled="check_bt_register">ສະໝັກບັນຊີ</button>
                            </div>

                            <p class="text-center warnjai-regular">
                                <span>ມີບັນຊີແລ້ວ!</span>
                                <router-link to="/login">
                                    <span> ເຂົ້າສູ່ລະບົບ</span>
                                </router-link>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'DGBWebsiteRegister',

    data() {
        return {
            show_error: false,
            error_mgs: '',
            name: '',
            email: '',
            password: '',
            confirm_password: ''
        };
    },
    computed: {
        check_bt_register() {
            if (this.name == '' || this.email == '' || this.password == '' || this.confirm_password == '') {
                return true
            } else {
                return false
            }
        }
    },

    mounted() {

    },

    methods: {
        register() {
            if (this.password == this.confirm_password) {
                this.show_error = false
                this.error_mgs = ''
                this.$axios.post("api/register", {
                    name: this.name,
                    email: this.email,
                    password: this.password
                }).then((response) => {
                    // console.log(response.data)
                    if (response.data.success) {
                        this.$swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: response.data.message,
                            showConfirmButton: false,
                            timer: 5000
                        });
                        // ໄປທີ່ໜ້າ Login
                        this.$router.push('login');
                    } else {
                        this.$swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: response.data.message,
                            showConfirmButton: false,
                            timer: 5000
                        });
                    }
                }).catch((error) => {
                    console.log(error)
                    if(error.response.status==401) {
                        this.$storage.setStorageSync("vue-isLoggin", false)
                        window.location.reload()
                    }
                });
            } else {
                this.show_error = true
                this.error_mgs = 'ລະຫັດຜ່ານບໍ່ກົງກັນ!'
            }
        }
    },
};
</script>

<style lang="scss" scoped></style>