<template>
  <div>
    <h3 style="color:white;">Profile</h3>

    <div v-for="pro in orderedProfile" :key="pro.id" >
      <div v-if="choices.authuser == pro.user_id" class="detailsDiv">
        Book Title: {{ choices.books[pro.book_id].title }}
        <br>
        Date Out: {{ pro.date_out }}
        <br>
        Due Date: {{ pro.due_date }}
        <br>
        Date In: {{ pro.date_in }}
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

<style>
.detailsDiv {
  border-radius: 5px;
  margin-bottom: 10px;
  padding: 10px;
  background: #ffffff;
  position: relative;
}
</style>
