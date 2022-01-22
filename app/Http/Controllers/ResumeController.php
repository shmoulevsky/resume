<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Models\Company;
use App\Services\Resume\ResumeService;
use PDF;

class ResumeController extends BaseController
{

    public function __construct(
        ResumeService $resumeService
    )
    {
        $this->resumeService = $resumeService;
    }

    public function index()
    {

        $currentRoute = Route::currentRouteName();
        $resumes = $this->resumeService->resumeRepository->getListPaginate(Auth::user()->id, 5);
        $resumeId = $resumes->pluck('id')->toArray();
        $photos = $this->resumeService->fileRepository->getPhotoForResume($resumeId);

        return view('mng.resume.list', compact('resumes', 'photos', 'currentRoute'));
    }

    public function indexCanban()
    {

        $user_id = Auth::user()->id;
        $resumeStatuses = $this->resumeService->resumeStatusRepository->all();
        $resumes = $this->resumeService->resumeRepository->getGroupedByStatus($user_id);
        $resumeId = $this->resumeService->resumeRepository->getListId($user_id)->pluck('id')->toArray();

        $photos = $this->resumeService->fileRepository->getPhotoForResume($resumeId);
        $currentRoute = Route::currentRouteName();

        return view('mng.resume.canban', compact('resumes', 'resumeStatuses', 'photos', 'currentRoute'));
    }

    public function show($id, Request $request)
    {

        $id = intval($id);
        $user = Auth::user();
        $companyId = $user->company;

        $arResume = $this->resumeService->getDetailInfo($id);
        $arResumeAdditional = $this->resumeService->getDetailAdditionalInfo($id);

        extract($arResume, EXTR_OVERWRITE);
        extract($arResumeAdditional, EXTR_OVERWRITE);

        return view('mng.resume.detail', compact('resume', 'form', 'formFields', 'resumeStatuses', 'testResults', 'testAssign', 'interviews', 'companyId', 'experience', 'education', 'userPhoto'));
    }

    public function delete($id, Request $request)
    {

        $item = $this->resumeService->resumeRepository->getById($id);
        $item->delete();
        $request->session()->flash('status', 'Запись удалена');

        return response()->json(['status' => 'deleted']);
    }

    public function exportPDF($id, Request $request)
    {
        return $this->resumeService->exportPDF($id);
    }

    public function changeStatus(Request $request)
    {

        $resume_id = $request->post('resume_id');
        $status_id = $request->post('status_id');
        $this->resumeService->changeStatus($resume_id, $status_id);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function changePoints(Request $request)
    {


        $resume_id = intval($request->post('resume_id'));
        $fields = $request->post('fields');

        $this->resumeService->changePoints($resume_id, $fields);

        return response()->json([
            'status' => 'success'
        ]);
    }

}
