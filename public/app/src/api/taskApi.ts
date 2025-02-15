import {createApi, fetchBaseQuery} from '@reduxjs/toolkit/query/react';
import {RootState} from "../features";

interface Task {
    id: number;
    title: string;
    description: string;
    status: string;
}

export const authApi = createApi({
    reducerPath: 'authApi',
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
    endpoints: (builder) => ({
        getAllTasks: builder.query<Task[], void>({
            query: () => "/tasks",
        }),
        getTaskById: builder.query<Task, number>({
            query: (id) => `/tasks/${id}`,
        }),
        createTask: builder.mutation<Task, Omit<Task, "id">>({
            query: (newTask) => ({
                url: "/tasks",
                method: "POST",
                body: newTask,
            }),
        }),
        updateTask: builder.mutation<Task, Task>({
            query: (task) => ({
                url: `/tasks/${task.id}`,
                method: "PUT",
                body: task,
            }),
        }),
        deleteTask: builder.mutation<{ success: boolean }, number>({
            query: (id) => ({
                url: `/tasks/${id}`,
                method: "DELETE",
            }),
        }),
    }),
});

export const {
    useGetAllTasksQuery,
    useGetTaskByIdQuery,
    useCreateTaskMutation,
    useUpdateTaskMutation,
    useDeleteTaskMutation
} = authApi;
