<template>
  <table-container>
    <template v-slot:head>
      <th>
        Order <i class="fas fa-sort-numeric-down"></i>
      </th>
      <th>
        <center>Image</center>
      </th>
      <th>Link</th>
      <th class="text-center">Expiration</th>
      <th style="min-width:125px" class="text-right">Actions</th>
    </template>
    <template v-slot:body>
      <advertisement-row
        v-for="(element, index) in elements"
        :key="element.order"
        :element="element"
        @delete="Delete(index, ...arguments)"
        @update="Update(index, ...arguments)"
        @create="Create(index, ...arguments)"
      ></advertisement-row>
    </template>
  </table-container>
</template>

<script>
export default {
  props: ["data"],
  methods: {
    Delete(index, id) {
      this.$swal
        .fire(
          this.$root.ConfirmMessageValue(
            "¿Are you sure to delete the element number " +
              this.elements[index].order +
              "?",
            "The image in the server is also deleted."
          )
        )
        .then((result) => {
          if (result.value) {
            this.$root.BasicLoading();
            axios.delete(`api/advertisement/${id}`).then(
              (response) => {
                this.elements[this.elements[index].order - 1] = {
                  order: this.elements[index].order,
                };
                this.$root.SuccessMessage("Element deleted!");
                this.$forceUpdate();
              },
              (error) => {
                this.$root.ErrorMessage("", error);
              }
            );
          }
        });
    },
    Create(index, data) {
      this.elements[index] = data;
      this.$forceUpdate();
    },
    Update(index, data) {
      if (data.order != index + 1) {
        // if there is a change in the order, the element that is going to be replaced
        //  is saved in the past order of the updated element.
        this.elements[index] = this.elements[data.order - 1];
        this.elements[index].order = index + 1;
      }
      this.elements[data.order - 1] = data;
      this.$forceUpdate();
    },
  },
  created() {
    var dataParseJson = JSON.parse(this.data);
    var extraelements = 0;
    this.$root.SetCurrentDate();
    for (var i = 0; i < 7; i++) {
      this.elements.push({ id: null, order: i + 1 });
    }
    for (var i = 0; i < dataParseJson.length; i++) {
      if (dataParseJson[i].order < 8)
        this.elements[dataParseJson[i].order - 1] = dataParseJson[i];
      else extraelements++;
    }
    //if the database has elements with order attribute up to 7, those elements are going to be excluded
    if (extraelements > 0)
      this.$root.InfoMessage(
        "Wrong data base.",
        "There are many element that reach the limit."
      );
  },
  data() {
    return {
      elements: [],
    };
  },
};
</script>
