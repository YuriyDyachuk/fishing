<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card">
          <h2 class="text-center">Чаты</h2>

          <table class="table">
            <thead>
            <tr>
              <th>#</th>
              <th>Автор</th>
              <th>Сообщение</th>
              <th>Время</th>
              <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(chat, index) in chats" :key="chat.id">
              <td>{{ ++index }}</td>
              <td>{{ chat.sender.name }}</td>
              <td>{{ chat.message }}</td>
              <td>{{ new Date(chat.created_at).toISOString().slice(0, 10) }}</td>
              <td>
<!--                <router-link :to="{name: 'show', params: { chatId: chat.id }}" class="btn btn-success btn-small">Открыть</router-link>-->
                <button class="btn btn-danger btn-small" @click="deleteChat(chat.id)">Удалить</button>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
      props: [
          'chats'
      ],
      mounted() {
        console.log(this.chats)
      },
      methods: {
        showChat(chatId) {
          this.axios
              .get(`http://localhost:3030/chats/${chatId}`)
              .then((res) => {
                // Todo
              });
        },
        deleteChat(chatId) {
          console.log(`http://localhost:3030/profile/${this.$userId}/chats/${chatId}`)
          this.axios
              .delete(`http://localhost:3030/profile/${this.$userId}/chats/${chatId}`)
              .then(response => {
                let i = this.chats.map(data => data.id).indexOf(id);
                this.chats.splice(i, 1)
              });
        }
      }
    }
</script>

<style>
  :root {
    --rad: .7rem;
    --dur: .3s;
    --color-dark: #2f2f2f;
    --color-light: #fff;
    --color-brand: #57bd84;
    --font-fam: 'Lato', sans-serif;
    --height: 5rem;
    --btn-width: 6rem;
    --bez: cubic-bezier(0, 0, 0.43, 1.49);
  }

  /*!*form {*/
  /*  position: relative;*/
  /*  width: 30rem;*/
  /*  background: var(--color-brand);*/
  /*  border-radius: var(--rad);*/
  /*}*/

  /*input, button {*/
  /*  height: var(--height);*/
  /*  font-family: var(--font-fam);*/
  /*  border: 0;*/
  /*  color: var(--color-dark);*/
  /*  font-size: 1.8rem;*/
  /*}*/

  /*input[type="search"] {*/
  /*  outline: 0;*/
  /*  width: 100%;*/
  /*  background: var(--color-light);*/
  /*  padding: 0 1.6rem;*/
  /*  border-radius: var(--rad);*/
  /*  appearance: none;*/
  /*  transition: all var(--dur) var(--bez);*/
  /*  transition-property: width, border-radius;*/
  /*  z-index: 1;*/
  /*  position: relative;*/
  /*}*/

  /*button {*/
  /*  display: none;*/
  /*  position: absolute;*/
  /*  top: 0;*/
  /*  right: 0;*/
  /*  width: var(--btn-width);*/
  /*  font-weight: bold;*/
  /*  background: var(--color-brand);*/
  /*  border-radius: 0 var(--rad) var(--rad) 0;*/
  /*}*/

  /*input:not(:placeholder-shown) {*/
  /*  border-radius: var(--rad) 0 0 var(--rad);*/
  /*  width: calc(100% - var(--btn-width));*/
  /*  + button {*/
  /*    display: block;*/
  /*  }*/
  /*}*/

  /*label {*/
  /*  position: absolute;*/
  /*  clip: rect(1px, 1px, 1px, 1px);*/
  /*  padding: 0;*/
  /*  border: 0;*/
  /*  height: 1px;*/
  /*  width: 1px;*/
  /*  overflow: hidden;*/
  /*}*!*/

</style>
