<template>
    <main>
        <header class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand text-success" :href="route('home')">Booker</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
<!--                        <li class="nav-item">-->
<!--                            <Link class="nav-link" :href="route('tests.create')">Create</Link>-->
<!--                        </li>-->
                    </ul>
                </div>
            </nav>
        </header>
        <article>
            <slot />
        </article>
    </main>
</template>

<script>

import { Link } from '@inertiajs/inertia-vue3'

export default {
    name: 'Layout',
    components: {
        Link,
    }
}

</script>

<style scoped>

</style>
