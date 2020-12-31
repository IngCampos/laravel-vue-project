  
<template>
  <table-container>
    <template v-slot:head>
      <th class="col-date">Date <i class="fas fa-sort-numeric-down"/></th>
      <th>Name / Email</th>
      <th>Type</th>
      <th>Actions</th>
    </template>
    <template v-slot:body>
      <complaint-row
        v-for="(complaint, index) in complaints"
        :key="complaint.id"
        :complaint="complaint"
        @delete="Delete(index,...arguments)"
      ></complaint-row>
    </template>
    <template v-slot:footer>
      <pagination
       :pagination="pagination" 
       :offset="offset"
       @changePage="getComplaints(...arguments)"/>
    </template>
  </table-container>
</template>

<script>
export default {
  methods: {
    getComplaints(page) {
      axios.get("api/complaint?page=" + page).then((response) => {
        this.complaints = response.data.complaints;
        this.pagination = response.data.pagination;
      });
    },
    Delete(index, id) {
      this.$swal
        .fire(
          this.$root.ConfirmMessageValue(
            "Are you sure to delete the complaint of " +
              this.complaints[index].name +
              "?",
            "Delete an important complaint could be sanctioned."
          )
        )
        .then((result) => {
          if (result.value) {
            this.$root.BasicLoading();
            axios.delete(`api/complaint/${id}`).then(
              (response) => {
                this.changePage(this.pagination.current_page);
                this.$root.SuccessMessage("Complaint deleted!");
              },
              (error) => {
                this.$root.ErrorMessage(
                  "Error in delete the complaint!",
                  error
                );
              }
            );
          }
        });
    }
  },
  created() {
    this.getComplaints(1);
  },
  data() {
    return {
      complaints: [],
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0,
      },
      offset: 4
    };
  },
};
</script>