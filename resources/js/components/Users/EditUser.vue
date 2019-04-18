<template>
  <div>
    <el-form :model="editedUser" ref="user" label-width="120px">
      <el-form-item label="First Name" for="ffirstname">
        <el-input id="ffirstname" v-model.lazy="$v.editedUser.first_name.$model"></el-input>
        <p v-if="errors" class="error">
          <span
            v-if="!$v.editedUser.first_name.required"
          >A user without a first name is like a pet without a name!</span>
        </p>
      </el-form-item>

      <el-form-item label="Last Name" for="flastname">
        <el-input id="flastname" v-model.lazy="$v.editedUser.last_name.$model"></el-input>
        <p v-if="errors" class="error">
          <span
            v-if="!$v.editedUser.last_name.required"
          >A user without a last name is like a plant without two names!</span>
        </p>
      </el-form-item>

      <el-form-item label="Email" for="femail">
        <el-input
          id="femail"
          v-model.lazy="$v.editedUser.email.$model"
          placeholder="xxxxx@xxxxx.xxx"
          type="email"
        ></el-input>
        <p v-if="errors" class="error">
          <span
            v-if="!$v.editedUser.email.required"
          >A user without an address is like a person without a phone!</span>
          <span
            v-if="!$v.editedUser.email.email"
          >A valid email follows the following format: xxx@xxx.com</span>
        </p>
      </el-form-item>

      <el-form-item label="Max Books" for="fmaxbooks">
        <el-input
          id="fmaxbooks"
          v-model.lazy="$v.editedUser.max_number_of_books_allowed.$model"
          type="number"
        ></el-input>
        <p v-if="errors" class="error">
          <span
            v-if="!$v.editedUser.max_number_of_books_allowed.required"
          >A user without a maximum limit is like a mat without a speed governor!</span>
        </p>
      </el-form-item>

      <el-form-item label="Status" for="fstatus">
        <el-radio-group id="fstatus" v-model.lazy="$v.editedUser.status.$model">
          <el-radio label="Active"></el-radio>
          <el-radio label="Suspended"></el-radio>
        </el-radio-group>
        <p v-if="errors" class="error">
          <span
            v-if="!$v.editedUser.status.required"
          >A user without a borrowing status is like a phone without WiFi!</span>
        </p>
      </el-form-item>

      <el-form-item label="Department" for="fdepartment">
        <el-select
          id="fdepartment"
          v-model.lazy="$v.editedUser.department_id.$model"
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
            v-if="!$v.editedUser.department_id.required"
          >A user without a department is like a game without thrones!</span>
        </p>
      </el-form-item>

      <el-form-item>
        <el-button type="primary" @click="editUser('user', editedUser)">Edit</el-button>
        <el-button @click="cancel">Cancel</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
import { required, email } from "vuelidate/lib/validators";

export default {
  props: ["user", "choices"],
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
      editedUser: this.user
    };
  },
  validations: {
    editedUser: {
      first_name: { required },
      last_name: { required },
      email: { required, email },
      max_number_of_books_allowed: { required },
      status: { required },
      department_id: { required }
    }
  },
  methods: {
    editUser(editedUser) {
      this.formTouched = !this.$v.editedUser.$anyDirty;
      this.errors = this.$v.editedUser.$anyError;
      this.uiState = "submit clicked";
      if (this.errors === false && this.formTouched === false) {
        axios.put("/api/users/" + editedUser.id, editedUser).then(response => {
          this.$router.push("/users");
          this.$notify({
            title: "Success",
            message: "The user details have been edited.",
            type: "success"
          });
          this.editedUser = {};
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
.error {
  color: #f56c6c;
}
</style>
