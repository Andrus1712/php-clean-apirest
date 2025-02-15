import {
    Task,
    useCreateTaskMutation,
    useDeleteTaskMutation,
    useGetAllTasksQuery,
    useUpdateTaskMutation
} from "../../api/taskApi.ts";
import {useState} from "react";

function Dashboard() {
    
    const {data: tasks, isLoading, isError, error} = useGetAllTasksQuery();
    const [newTask, setNewTask] = useState({title: "", description: "", status: "pending"});
    const [createTask] = useCreateTaskMutation();
    const [updateTask] = useUpdateTaskMutation();
    const [deleteTask] = useDeleteTaskMutation();
    
    if (isLoading) return <p className="text-center text-gray-500">Loading...</p>;
    if (isError) return <pre className="text-red-500">{JSON.stringify(error, null, 2)}</pre>;
    
    
    return (
        <>
            <div className="max-w-2xl mx-auto p-4">
                {/* Formulario para añadir nueva tarea */}
                <div className="bg-white p-4 rounded-lg shadow mb-4">
                    <h2 className="text-lg font-semibold mb-2">Añadir Nueva Tarea</h2>
                    <input
                        type="text"
                        placeholder="Título"
                        value={newTask.title}
                        onChange={(e) => setNewTask({...newTask, title: e.target.value})}
                        className="w-full p-2 border rounded mb-2"
                    />
                    <textarea
                        placeholder="Descripción"
                        value={newTask.description}
                        onChange={(e) => setNewTask({...newTask, description: e.target.value})}
                        className="w-full p-2 border rounded mb-2"
                    />
                    <button
                        onClick={() => {
                            if (newTask.title && newTask.description) {
                                createTask(newTask);
                                setNewTask({title: "", description: "", status: "pending"});
                            }
                        }}
                        className="w-full bg-blue-500 text-white py-2 rounded"
                    >
                        Agregar Tarea
                    </button>
                </div>
                
                
                {tasks?.length ? (
                    <div className="space-y-3 overflow-y-auto h-96">
                        {tasks.map((task: Task) => (
                            <div key={task.id}
                                 className="bg-gray-100 p-4 rounded-lg shadow flex justify-between items-center">
                                <div>
                                    <h3 className="font-bold">{task.title}</h3>
                                    <p className="text-gray-600">{task.description}</p>
                                    <p className={`text-sm ${task.status === "completed" ? "text-green-600" : "text-orange-600"}`}>
                                        {task.status}
                                    </p>
                                </div>
                                <div className="flex gap-2">
                                    <button
                                        onClick={() => updateTask({...task, status: "completed"})}
                                        className="bg-green-500 text-white px-3 py-1 rounded"
                                    >
                                        ✅
                                    </button>
                                    <button
                                        onClick={() => deleteTask(task.id)}
                                        className="bg-red-500 text-white px-3 py-1 rounded"
                                    >
                                        ❌
                                    </button>
                                </div>
                            </div>
                        ))}
                    </div>
                ) : (
                    <p className="text-center text-gray-500">No tasks found</p>
                )}
            </div>
        </>
    );
}

export default Dashboard;
