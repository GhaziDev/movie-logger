<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';


import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'




interface Movie {
    id:number,
    name:string,
    rating:string,
    favorite:string
 } // don't forget to cast in backend

interface Props {
    movies: Movie[]
}
const props = defineProps<Props>()
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Movies',
        href: '/movies',
    },
];

const handleDelete = (id:number):void=>{
  router.delete(route('movies.delete',{id:id}));
}

const page = usePage()
</script>

<template>
    <Head title="Movies" />

    <AppLayout :breadcrumbs="breadcrumbs">
            <div v-if="page.props.flash?.message" class="alert">
        
    </div>


    <Link :href="route('movies.create')"><Button>Add a movie</Button></Link> 

    <div id="movies-display">
        <Table>
  <TableCaption>Your Movies list</TableCaption>
  <TableHeader>
    <TableRow>
      <TableHead className="w-[100px]">Name</TableHead>
      <TableHead>Rating</TableHead>
      <TableHead>Favorite</TableHead>

    </TableRow>
  </TableHeader>
  <TableBody>
    <TableRow v-for="movie in props.movies" :key="movie.id" >
      <TableCell className="font-medium">{{ movie.name }}</TableCell>
      <TableCell>{{movie.rating }}</TableCell>
      <TableCell>{{movie.favorite}}</TableCell>
        <TableCell><Link :href="route('movies.put',{id:movie.id})" >Edit</Link></TableCell>
                <TableCell><Button class=" bg-red-500 p-2 rounded-[4px]"  @click="()=>handleDelete(movie.id)">Delete</Button></TableCell>

    </TableRow>

  </TableBody>
</Table>

    </div>
    </AppLayout>
</template>
