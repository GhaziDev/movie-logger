<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import {useForm} from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: '/Add a Movie',
        href: '/movies/create',
    },
];

const form = useForm({
  name: '',
  rating: 0,
  favorite: 'no',
})

const handleSubmit = ()=>{

    form.post("/movies/post/",{
        onSuccess:()=>{form.reset()}
    })
}
</script>

<template>
    <Head title="Add a Movies" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <form @submit.prevent="handleSubmit" class="flex flex-wrap flex-col gap-1">
            <div class="flex flex-col gap-2 flex-wrap">
            <Label>
                Movie Title
            </Label>

            <Input v-model="form.name" type="text" placeholder="Insert Movie name"></Input>
            <div class=" text-red-600 border text-[12px]" v-if="form.errors.name">{{ form.errors.name }}</div> 
            </div>

               <div class="flex flex-col gap-2 flex-wrap">
            <Label>
                Rating
            </Label>

            <Input className="w-full" step="0.5" min="0.5" max="5" list="values" type="range" v-model="form.rating" ></Input>
            <datalist id="values" className=" grid grid-cols-10">
                <option class=" text-left" value="0.5" label="Ugly"></option>
                <option class=" text-center"  value="1" label="Very Horrible"></option>
                <option class="text-center"  value="1.5" label="Horrible"></option>
                <option class="text-center"  value="2" label="Very Bad"></option>
                <option class="text-center"  value="2.5" label="Bad"></option>
                <option class="text-center" value="3" label="Good"></option>
                <option class="text-center"  value="3.5" label="Very Good"></option>
                <option class="text-center"  value="4" label="Excellent"></option>
                <option class="text-center"  value="4.5" label="Outstanding"></option>
                <option class="text-right"  value="5" label="Absolute Cinema"></option>


            </datalist>
              <div class=" text-red-600 border text-[12px]" v-if="form.errors.rating">{{ form.errors.rating}}</div> 

            </div>
            
               <div class="flex flex-col gap-2 flex-wrap">
            <Label for="fav">
                Favourite?
            </Label>
            <select placeholder="yes/no" name="fav" id="fav" v-model="form.favorite" >
                <option value="yes">Yes</option>
                <option selected value="no">No</option>
            </select>
            </div>
            
            <Button type="submit">Add movie</Button>
        </form>
    </AppLayout>
</template>
