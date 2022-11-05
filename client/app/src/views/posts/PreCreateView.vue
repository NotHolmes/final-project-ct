<template>
        <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
            <div class="flex flex-col bg-white border rounded shadow-sm md:justify-center lg:flex-row">
                <div class="flex flex-col justify-between p-5 border-b sm:p-10 lg:border-b-0 lg:border-r lg:w-1/2">
                    <div>
                        <p class="mb-2 text-xs font-semibold tracking-wide uppercase">
                            Create
                        </p>
                        <h5 class="max-w-md mb-6 text-3xl font-extrabold leading-none sm:text-4xl">
                            Lost
                        </h5>
                        <p class="mb-6 text-base text-gray-700 md:text-lg sm:mb-8">
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae. explicabo.
                        </p>
                    </div>
                    <div class="flex items-center">
<!--                        <button-->
<!--                            type="submit"-->
<!--                            class="inline-flex items-center justify-center h-12 px-6 mr-6 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-deep-purple-accent-400 hover:bg-deep-purple-accent-700 focus:shadow-outline focus:outline-none"-->
<!--                        >-->
<!--                            Get started-->
<!--                        </button>-->

                            <RouterLink :to="{
                            name: 'posts.create',
                        params: {is_lost: 1}
                        }"
                                        aria-label="Create post"
                                        title="Create post"
                                        class="inline-flex items-center justify-center h-12 px-6 mr-6 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-deep-purple-accent-400 hover:bg-deep-purple-accent-700 focus:shadow-outline focus:outline-none"
                            >Create post</RouterLink
                            >

                        <a href="/" aria-label="" class="inline-flex items-center font-semibold transition-colors duration-200 text-deep-purple-accent-400 hover:text-deep-purple-800">Learn more</a>
                    </div>
                </div>
                <div class="flex flex-col justify-between p-5 sm:p-10 lg:w-1/2">
                    <div>
                        <p class="mb-2 text-xs font-semibold tracking-wide uppercase">
                            Create
                        </p>
                        <h5 class="max-w-md mb-6 text-3xl font-extrabold leading-none sm:text-4xl">
                            Found
                        </h5>
                        <p class="mb-6 text-base text-gray-700 md:text-lg sm:mb-8">
                            Disrupt inspire and think tank, social entrepreneur but preliminary thinking think tank compelling.
                        </p>
                    </div>
                    <div class="flex items-center">
                        <RouterLink :to="{
                            name: 'posts.create',
                        params: {is_lost: 0}
                        }"
                                    aria-label="Create post"
                                    title="Create post"
                                    class="inline-flex items-center justify-center h-12 px-6 mr-6 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-deep-purple-accent-400 hover:bg-deep-purple-accent-700 focus:shadow-outline focus:outline-none"
                        >Create post</RouterLink
                        >

                        <a href="/" aria-label="" class="inline-flex items-center font-semibold transition-colors duration-200 text-deep-purple-accent-400 hover:text-deep-purple-800">Learn more</a>
                    </div>
                </div>
            </div>
        </div>
</template>


<script>

</script>
