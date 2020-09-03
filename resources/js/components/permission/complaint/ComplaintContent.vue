  
<template>
  <div style="overflow-x:auto;">
    <table style="width:100%" class="table table-striped">
      <thead>
        <tr>
          <th style="min-width:90px">
            Date
            <i class="fas fa-sort-numeric-down"></i>
          </th>
          <th>Name / Email</th>
          <th class="text-center">Tipo</th>
          <th style="min-width:215px" class="text-right">Actions</th>
        </tr>
      </thead>
      <tbody>
        <complaint-element
          v-for="(complaint, index) in complaints"
          :key="complaint.id"
          :complaint="complaint"
          @delete="Delete(index,...arguments)"
        ></complaint-element>
      </tbody>
    </table>
    <nav aria-label="Page navigation">
      <ul class="pagination justify-content-center">
        <li class="page-item" v-bind:class="[ pagination.current_page > 1 ? '' : 'disabled' ]">
          <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page - 1)">
            <span>Previous</span>
          </a>
        </li>
        <li
          v-for="page in pagesNumber"
          v-bind:class="[ page == isActive ? 'active' : '' ]"
          :key="page"
          class="page-item"
        >
          <a class="page-link" href="#" @click.prevent="changePage(page)">{{page}}</a>
        </li>
        <li
          class="page-item"
          v-bind:class="[ pagination.current_page < pagination.last_page ? '' : 'disabled' ]"
        >
          <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page + 1)">
            <span>Next</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  computed: {
    isActive: function () {
      return this.pagination.current_page;
    },
    pagesNumber: function () {
      if (!this.pagination.to) {
        return [];
      }
      var from = this.pagination.current_page - this.offset;
      if (from < 1) from = 1;
      var to = from + this.offset * 2;
      if (to >= this.pagination.last_page) to = this.pagination.last_page;
      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    },
  },
  methods: {
    getComplaints(page) {
      axios.get("api/complaint?page=" + page).then((response) => {
        this.complaints = response.data.complaints.data;
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
            "The complaint could not be recovered."
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
    },
    changePage(page) {
      this.pagination.current_page = page;
      this.getComplaints(page);
    },
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
      offset: 3,
    };
  },
};
</script>