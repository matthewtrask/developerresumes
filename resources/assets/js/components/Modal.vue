
<style lang="scss" scoped>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }

    .modal {
        margin-right: auto;
        margin-left: auto;
        margin-top: 5rem;
    }

</style>
<template>
    <transition name="modal">
        <div class="modal-mask block">
            <div class="modal bg-white container w-3/5" role="document">
                <div class="modal-content">
                    <div class="modal-header border-b border-solid border-purple-dark">
                        <slot name="header"></slot>
                    </div>

                    <div class="modal-body">
                        <slot name="body"></slot>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer"></slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
<script>
  import axios from 'axios';

  export default {};
</script>