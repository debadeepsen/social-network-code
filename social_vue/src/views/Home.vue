<template>
  <div class="home">
    <textarea :value="insertStr"></textarea>
  </div>
</template>

<script>
export default {
  name: 'Home',
  data() {
    return {
      users: [],
      pics: [],
      insertStr: '',
    }
  },

  mounted() {
    fetch('https://randomuser.me/api/?results=75&gender=male')
      .then((r) => r.json())
      .then((d) => {
        this.users = d.results
        fetch('https://socialnetwork.softwarecradle.com/')
          .then((s) => s.json())
          .then((res) => {
            this.pics = res
            console.log(this.users)
            this.users.forEach((u, i) => {
              console.log({ i })
              this.insertStr += `Insert into \`user\` (firstname, lastname, gender, email, profilepic) 
                                  values ('${u.name.first}', '${u.name.last}', 'F', '${u.email}', '${res.M[i]}');\n`
            })
          })
      })
  },
}
</script>
