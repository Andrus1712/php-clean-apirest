import {createApi, fetchBaseQuery} from '@reduxjs/toolkit/query/react';
import {RootState} from "../features";

export interface Task {
    id: number;
    title: string;
    description: string;
    status: string;
}

export const taskApi = createApi({
    reducerPath: 'taskApi',
    baseQuery: fetchBaseQuery(
        {
            baseUrl: 'http://localhost:9000',
            prepareHeaders: (headers, {getState}) => {
                const token = (getState() as RootState).token.value;
                if (token) {
                    headers.set("Authorization", `Bearer ${token}`);
                }
                return headers;
            },
        }),
    tagTypes: ["Task"],
    endpoints: (builder) => ({
        getAllTasks: builder.query<Task[], void>({
            query: () => "/tasks",
            providesTags: ["Task"],
        }),
        getTaskById: builder.query<Task, number>({
            query: (id) => `/tasks/${id}`,
            providesTags: ["Task"],
        }),
        createTask: builder.mutation<Task, Omit<Task, "id">>({
            query: (newTask) => ({
                url: "/tasks",
                method: "POST",
                body: newTask,
            }),
            invalidatesTags: ["Task"],
        }),
        updateTask: builder.mutation<Task, Task>({
            query: (task) => ({
                url: `/tasks/update/${task.id}`,
                method: "POST",
                body: task,
            }),
            invalidatesTags: ["Task"],
        }),
        deleteTask: builder.query<{ success: boolean }, number>({
            query: (id) => `/tasks/delete/${id}`,
            providesTags: ["Task"],
        }),
    }),
});

export const {
    useGetAllTasksQuery,
    useGetTaskByIdQuery,
    useCreateTaskMutation,
    useUpdateTaskMutation,
    useLazyDeleteTaskQuery
} = taskApi;
