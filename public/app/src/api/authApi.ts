import {createApi, fetchBaseQuery} from '@reduxjs/toolkit/query/react';

interface ResponseAuth {
    token: string;
    email: string;
    name: string;
}

interface Ilogin {
    email: string;
    password: string;
}

export const authApi = createApi({
    reducerPath: 'authApi',
    baseQuery: fetchBaseQuery(
        {
            baseUrl: 'http://localhost:9000',
        }),
    tagTypes: ['auth'],
    endpoints: (builder) => ({
        authUser: builder.mutation<ResponseAuth, Ilogin>({
            query: (data: Ilogin) => ({
                url: "/auth/login",
                method: "POST",
                body: data,
            }),
        }),
    }),
    
});

export const {useAuthUserMutation} = authApi;
