<template>
  <div>
    <h3 style="color:white;">Profile</h3>

    <div style="color:white;" v-for="pro in orderedProfile" :key="pro.id">
      <div v-if="choices.authuser == pro.user_id">
        <p>{{ choices.books[pro.book_id].title }}</p>
        <p>{{ pro.date_out }}</p>
        <p>{{ pro.due_date }}</p>
        <p>{{ pro.date_in }}</p>
      </div>
    </div>

    <!-- <button style="background-color: red;" @click="reveal">Some</button> -->
  </div>
</template>

<script>
export default {
  computed: {
    orderedProfile() {
      return _.orderBy(this.profile, "due_date", "desc");
    }
  },
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
