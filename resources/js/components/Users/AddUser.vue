<template>
  <div>
    <el-form :model="user" ref="user" label-width="120px">
      <el-form-item label="First Name" for="ffirstname">
        <el-input id="ffirstname" v-model="$v.user.first_name.$model"></el-input>
        <p v-if="errors" class="error">
          <span
            v-if="!$v.user.first_name.required"
          >A user without a first name is like a pet without a name!</span>
        </p>
      </el-form-item>

      <el-form-item label="Last Name" for="flastname">
        <el-input id="flastname" v-model="$v.user.last_name.$model"></el-input>
        <p v-if="errors" class="error">
          <span
            v-if="!$v.user.last_name.required"
          >A user without a last name is like a plant without two names!</span>
        </p>
      </el-form-item>

      <el-form-item label="Email" for="femail">
        <el-input
          id="femail"
          v-model="$v.user.email.$model"
          placeholder="xxxxx@xxxxx.xxx"
          type="email"
        ></el-input>
        <p v-if="errors" class="error">
          <span
            v-if="!$v.user.email.required"
          >A user without an address is like a person without a phone!</span>
          <span v-if="!$v.user.email.email">A valid email follows the following format: xxx@xxx.com</span>
        </p>
      </el-form-item>

      <el-form-item label="Password" for="fpassword">
        <el-input id="fpassword" v-model="$v.user.password.$model"></el-input>
        <p v-if="errors" class="error">
          <span
            v-if="!$v.user.password.required"
          >A user without a password is like a person without a name!</span>
          <span v-if="!$v.user.password.minLength">A strong password has at least 8 characters</span>
        </p>
      </el-form-item>

      <el-form-item label="Max Books" for="fmaxbooks">
        <el-input
          id="fmaxbooks"
          v-model.lazy="$v.user.max_number_of_books_allowed.$model"
          type="number"
        ></el-input>
        <p v-if="errors" class="error">
          <span
            v-if="!$v.user.max_number_of_books_allowed.required"
          >A user without a maximum limit is like a mat without a speed governor!</span>
        </p>
      </el-form-item>

      <el-form-item label="Status" for="fstatus">
        <el-radio-group id="fstatus" v-model.lazy="$v.user.status.$model">
          <el-radio label="1">Active</el-radio>
          <el-radio label="2">Suspended</el-radio>
        </el-radio-group>
      </el-form-item>

      <el-form-item label="Access Level" for="fal">
        <el-radio-group id="fal" v-model.lazy="$v.user.accesslevel_id.$model">
          <el-radio label="1">Admin</el-radio>
          <el-radio label="2">Normal</el-radio>
        </el-radio-group>
      </el-form-item>

      <el-form-item label="Department" for="fdepartment">
        <el-select
          id="fdepartment"
          v-model.lazy="$v.user.department_id.$model"
          placeholder="Department"
        >
          <el-option
            v-for="department in orderedDepartments"
            :value="department.id"
            :key="department.id"
            :label="department.name"
          >{{ department.name }}</el-option>
        </el-select>
        <p v-if="errors" class="error">
          <span
            v-if="!$v.user.department_id.required"
          >A user without a department is like a game without thrones!</span>
        </p>
      </el-form-item>

      <el-form-item>
        <el-button type="primary" @click="addUser('user', user)">Create</el-button>
        <el-button @click="cancel">Cancel</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
import { required, email, minLength } from "vuelidate/lib/validators";

export default {
  props: ["choices"],
  computed: {
    orderedDepartments() {
      return _.orderBy(this.choices.departments, "name");
    }
  },
  data() {
    return {
      uiState: "submit not clicked",
      errors: false,
      empty: true,
      formTouched: false,
      user: {
        first_name: "",
        last_name: "",
        email: "",
        password: "",
        max_number_of_books_allowed: 3,
        status: "1",
        accesslevel_id: "2",
        department_id: ""
      }
    };
  },
  validations: {
    user: {
      first_name: { required },
      last_name: { required },
      email: { required, email },
      password: { required, minLength: minLength(8) },
      max_number_of_books_allowed: { required },
      status: { required },
      accesslevel_id: { required },
      department_id: { required }
    }
  },
  methods: {
    addUser() {
      this.formTouched = !this.$v.user.$anyDirty;
      this.errors = this.$v.user.$anyError;
      this.uiState = "submit clicked";
      if (this.errors === false && this.formTouched === false) {
        axios.post("/api/users/", this.user).then(response => {
          this.$router.push("/users");
          this.$notify({
            title: "Success",
            message: "The new user has been added.",
            type: "success"
          });
          this.uiState = "form submitted";
        });
      } else {
        return false;
      }
    },
    cancel() {
      this.$router.push("/users");
      this.$notify({
        title: "Info",
        message: "Changes, if any, have been discarded",
        type: "info"
      });
    }
  }
};
</script>

<style>
</style>
