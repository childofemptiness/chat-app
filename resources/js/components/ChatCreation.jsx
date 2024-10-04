import {useState} from "react";

const ChatCreation = ({ addChat }) => {

    const [chatName, setChatName] = useState('');
    const [loading, setLoading] = useState('');
    const [error, setError] = useState('');

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const handleCreateChat = () => {

        addChat(chatName);

        if (chatName.trim()) {

            setLoading('');

            setError('');

            try {

                fetch('/chats', {

                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({name: chatName}),
                })
                .then(response => response.json())
                .then(data => {

                    console.log(data.status);
                });
            
            } catch (err) {

                setError('Failed to create chat');
            
            } finally {

                setLoading(false);
            }
        }
    };

    return (
            <div className="flex flex-col items-center space-y-4 p-4 bg-gray-800 text-white">
                <input 
                    type="text" 
                    value={chatName} 
                    onChange={(e) => setChatName(e.target.value)} 
                    placeholder="Введите название нового чата" 
                    className="border border-blue-500 bg-gray-700 text-white placeholder-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent rounded-md p-2"
                />
                <button 
                    onClick={handleCreateChat} 
                    className="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out shadow-lg transform hover:scale-105"
                >
                    Создать чат
                </button>
            </div>
    )
};

export default ChatCreation;