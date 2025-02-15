import {useGetAllTasksQuery} from "../../api/taskApi.ts";

function Dashboard() {
    
    const {data, isLoading, isError, error} = useGetAllTasksQuery();
    
    if (isLoading) {
        return <>Loading...</>
    }
    
    if (isError) {
        return <>{error}</>
    }
    
    
    return (
        <>
            {data ?
                data.map(task => {
                    return <p>{task.id}</p>
                })
                : <>
                    No tasks founds
                </>}
        </>
    );
}

export default Dashboard;
