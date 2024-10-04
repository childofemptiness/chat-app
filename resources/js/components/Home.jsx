import { useState } from "react";

import ChatCreation from "./ChatCreation";
import ChatList from "./ChatList";

function Home() {

    const [chats, setChats] = useState([]);

    const addChat = (name) => {

        const newChat = {name, messages: []};

        setChats([...chats, newChat]);
    }

    return (

        <div>

            <ChatList chats={chats} />

            <ChatCreation addChat={addChat} />

        </div>
    );
}

export default Home;