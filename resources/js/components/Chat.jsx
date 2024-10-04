
import Message from "./Message";


function Chat() {

    const urlSegments = window.location.pathname.split('/');

    const chatId = urlSegments[urlSegments.length - 1];

    return (

        <div>

            <Message chatId={chatId} />

        </div>

    );
}

export default Chat;