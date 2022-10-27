<script setup>
import WelcomeItem from './WelcomeItem.vue'
import DocumentationIcon from './icons/IconDocumentation.vue'
import ToolingIcon from './icons/IconTooling.vue'
import EcosystemIcon from './icons/IconEcosystem.vue'
import CommunityIcon from './icons/IconCommunity.vue'
import SupportIcon from './icons/IconSupport.vue'
</script>

<template>

    <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
        <div class="grid max-w-screen-lg gap-8 row-gap-5 md:row-gap-8 sm:mx-auto lg:grid-cols-2">
            <div class="transition duration-300 transform bg-white rounded shadow-sm hover:-translate-y-1 hover:shadow md:text-center">
                <div class="relative">
                    <img class="object-cover w-full h-64 rounded-t lg:h-80 xl:h-96" src="https://images.pexels.com/photos/3182796/pexels-photo-3182796.jpeg?auto=compress&amp;cs=tinysrgb&amp;dpr=2&amp;h=750&amp;w=1260" alt="" />
                    <div class="absolute inset-0 bg-gray-800 bg-opacity-25"></div>
                </div>
                <div class="px-6 py-8 border border-t-0 rounded-b sm:px-8">
                    <h5 class="mb-2 text-xl font-bold leading-none sm:text-2xl">
                        Lost
                    </h5>
                    <p class="mb-5 text-gray-700">
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque rem aperiam, eaque ipsa quae. Sed ut perspiciatis unde.
                    </p>
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center h-12 px-6 text-white font-medium tracking-wide transition duration-200 rounded shadow-md bg-deep-purple-accent-400 hover:bg-deep-purple-accent-700 focus:shadow-outline focus:outline-none"
                    >
                        Read more
                    </button>
                </div>
            </div>
            <div class="transition duration-300 transform bg-white rounded shadow-sm hover:-translate-y-1 hover:shadow md:text-center">
                <div class="relative">
                    <img class="object-cover w-full h-64 rounded-t lg:h-80 xl:h-96" src="https://images.pexels.com/photos/3184360/pexels-photo-3184360.jpeg?auto=compress&amp;cs=tinysrgb&amp;dpr=2&amp;h=750&amp;w=1260" alt="" />
                    <div class="absolute inset-0 bg-gray-800 bg-opacity-25"></div>
                </div>
                <div class="px-6 py-8 border border-t-0 rounded-b sm:px-8">
                    <h5 class="mb-2 text-xl font-bold leading-none sm:text-2xl">
                        Found
                    </h5>
                    <p class="mb-5 text-gray-700">
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque rem aperiam, eaque ipsa quae. Sed ut perspiciatis unde.
                    </p>
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center h-12 px-6 text-white font-medium tracking-wide transition duration-200 rounded shadow-md bg-deep-purple-accent-400 hover:bg-deep-purple-accent-700 focus:shadow-outline focus:outline-none"
                    >
                        Read more
                    </button>
                </div>
            </div>
        </div>
    </div>
<!--  <WelcomeItem>-->
<!--    <template #icon>-->
<!--      <DocumentationIcon />-->
<!--    </template>-->
<!--    <template #heading>Documentation</template>-->

<!--    Vue’s-->
<!--    <a target="_blank" href="https://vuejs.org/">official documentation</a>-->
<!--    provides you with all information you need to get started.-->
<!--  </WelcomeItem>-->

<!--  <WelcomeItem>-->
<!--    <template #icon>-->
<!--      <ToolingIcon />-->
<!--    </template>-->
<!--    <template #heading>Tooling</template>-->

<!--    This project is served and bundled with-->
<!--    <a href="https://vitejs.dev/guide/features.html" target="_blank">Vite</a>. The recommended IDE-->
<!--    setup is <a href="https://code.visualstudio.com/" target="_blank">VSCode</a> +-->
<!--    <a href="https://github.com/johnsoncodehk/volar" target="_blank">Volar</a>. If you need to test-->
<!--    your components and web pages, check out-->
<!--    <a href="https://www.cypress.io/" target="_blank">Cypress</a> and-->
<!--    <a href="https://on.cypress.io/component" target="_blank"-->
<!--      >Cypress Component Testing</a-->
<!--    >.-->

<!--    <br />-->

<!--    More instructions are available in <code>README.md</code>.-->
<!--  </WelcomeItem>-->

<!--  <WelcomeItem>-->
<!--    <template #icon>-->
<!--      <EcosystemIcon />-->
<!--    </template>-->
<!--    <template #heading>Ecosystem</template>-->

<!--    Get official tools and libraries for your project:-->
<!--    <a target="_blank" href="https://pinia.vuejs.org/">Pinia</a>,-->
<!--    <a target="_blank" href="https://router.vuejs.org/">Vue Router</a>,-->
<!--    <a target="_blank" href="https://test-utils.vuejs.org/">Vue Test Utils</a>, and-->
<!--    <a target="_blank" href="https://github.com/vuejs/devtools">Vue Dev Tools</a>. If you need more-->
<!--    resources, we suggest paying-->
<!--    <a target="_blank" href="https://github.com/vuejs/awesome-vue">Awesome Vue</a>-->
<!--    a visit.-->
<!--  </WelcomeItem>-->

<!--  <WelcomeItem>-->
<!--    <template #icon>-->
<!--      <CommunityIcon />-->
<!--    </template>-->
<!--    <template #heading>Community</template>-->

<!--    Got stuck? Ask your question on-->
<!--    <a target="_blank" href="https://chat.vuejs.org">Vue Land</a>, our official Discord server, or-->
<!--    <a target="_blank" href="https://stackoverflow.com/questions/tagged/vue.js">StackOverflow</a>.-->
<!--    You should also subscribe to-->
<!--    <a target="_blank" href="https://news.vuejs.org">our mailing list</a> and follow the official-->
<!--    <a target="_blank" href="https://twitter.com/vuejs">@vuejs</a>-->
<!--    twitter account for latest news in the Vue world.-->
<!--  </WelcomeItem>-->

<!--  <WelcomeItem>-->
<!--    <template #icon>-->
<!--      <SupportIcon />-->
<!--    </template>-->
<!--    <template #heading>Support Vue</template>-->

<!--    As an independent project, Vue relies on community backing for its sustainability. You can help-->
<!--    us by-->
<!--    <a target="_blank" href="https://vuejs.org/sponsor/">becoming a sponsor</a>.-->
<!--  </WelcomeItem>-->

</template>
