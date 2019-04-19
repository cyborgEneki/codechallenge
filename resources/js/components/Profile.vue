<template>
  <div>
    <h3 style="color:white;">Profile</h3>

    <table class="font-14">
      <thead>
        <tr>
          <th width="15%">First Name</th>
          <th width="15%">Last Name</th>
          <th width="15%">Email</th>
          <th width="15%" class="center">Maximum Number of Books Allowed</th>
          <th width="15%">Status</th>
          <th width="15%">Department</th>
          <th class="actions-column">Options</th>
        </tr>
      </thead>
      <tbody>
        <div style="color:white;" v-for="pro in profile" :key="pro.id">
          <div v-if="choices.authuser == pro.user_id">
            {{ pro.due_date }}
            {{ pro.date_in }}
            {{ pro.date_out }}
            {{ choices.books[pro.book_id].title }}
          </div>
        </div>
      </tbody>
    </table>

    <!-- <button style="background-color: red;" @click="reveal">Some</button> -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      profile: [],
      choices: []
    };
  },
  mounted() {
    axios.get("/api/profile").then(response => {
      this.profile = response.data;
      console.log(this.profile);
    });
    axios.get("/api/choices").then(response => {
      this.choices = response.data;
      this.choices;
    });
  }
};
</script>
