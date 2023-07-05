<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB as DB;
use Illuminate\Http\Request;

use App\Models\Event; /* Chamar o model do BD para poder utilizar os dados buscados do BD */
use App\Models\User;

class EventController extends Controller
{
    public function index() {

        $search = request('search');
        

        /* Campo de Busca por registro no BD */
        if($search) {
            $events = Event::where ([
                ['title', 'like', '%'.$search.'%']
            ])->get();
        } else { /* Retorna todos os registros */
            $events = Event::all(); 
        }

    

        return view('welcome',['events' => $events, 'search' => $search]);

    }  /* Fim public index */

    public function create() {
        return view('events.create');
    }

    public function contact() {
        return view('contact');
    }

    public function show($id) {

        $event = Event::findOrFail($id);

        $user = auth()->user();
        $hasUserJoined = false;

        if($user) {
            $userEvents = $user->eventsAsParticipant->toArray();

            foreach($userEvents as $userEvent) {
                if($userEvent['id'] == $id) {
                    $hasUserJoined = true;
                }
            }
        }

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();  /* buscar o usuário que fez o post */

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);

    }

    public function dashboard() {

        $user = auth()->user();

        $events = $user->events;

        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard', ['events'=>$events, 'eventsasparticipant' => $eventsAsParticipant]);
    }

    public function destroy($id) {
        $event = Event::findOrFail($id); 
        DB::table('event_user')->where('event_id', $id)->delete();
        Event::findOrFail($id)->delete();
        unlink(public_path("img/events/".$event->image)); // deletar a img no repositório tbm
        
        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso!');
    }

    public function edit($id) {

        $user = auth()->user();

        $event = Event::findOrFail($id);

        if($user->id != $event->user_id) {  // apenas o usuário com o mesmo id do usuário do projeto poderá editá-lo  
            return redirect('/dashboard')->with('msg', 'Você não tem permissão para editar esse projeto!');
        }

        return view('events.edit', ['event'=>$event]);
    }

    public function update(Request $request) {
        
        $event = Event::findOrFail($request->id); // Foto antiga será exluída ao atualizar
        $data = $request->all();

        if ($request->hasFile("image") && $request->file("image")->isValid()) {
            unlink(public_path("img/events/".$event->image));
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName().strtotime("now")).".".$extension;
            $requestImage->move(public_path("img/events"), $imageName);
            $data["image"]=$imageName;
        }
        
        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');
    }

    public function store(Request $request) {

        $event = new Event;  /* Criar um novo registro no BD */

        $event->title = $request->title;
        $event->description = $request->description;
        $event->link = $request->link;
        $event->gitlink = $request->gitlink;
        $event->data_criacao = $request->data_criacao;
        $event->items = $request->items;

        // Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $event->image = $imageName;
        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save(); /* Salvar os dados vindos do formulário no BD */

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function joinEvent($id) {

        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return back()->with('msg', 'Projeto adicionado aos seus favoritos!');
    }

    public function leaveEvent($id) {

        $user = auth()->user();

        $user->eventsAsParticipant()->detach($id);

        $event = Event::findOrFail($id);

        return back()->with('msg', 'Projeto removido dos seus favoritos!');
    }

}
