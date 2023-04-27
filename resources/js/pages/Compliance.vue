<template>
    <div>
        <div class="col-xxl black">
            <div class="card mb-4">
                <div class="card-header text-center">
                    <h5 style="font-size: 24px; color: black; font-weight: bold;" class="mb-0">DLLC Ethical Clean Center
                        (Anonymity)</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <h6 class="mb-0" style="color:black">(DLLC Ethical Clean Center- Home page screen sample)</h6>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name" style="color:black">Recipient (<span
                                style="color: red">*</span>)</label>
                        <div class="col-sm-10">
                            <input type="text" v-model="recipient" class="form-control" id="basic-default-name"
                                placeholder="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-company" style="color:black">Type of
                            report (<span style="color: red">*</span>)</label>
                        <div class="col-sm-10">
                            <input type="text" v-model="type_of_report" class="form-control" id="basic-default-company"
                                placeholder="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-company" style="color:black">Title (<span
                                style="color: red">*</span>)</label>
                        <div class="col-sm-10">
                            <select id="largeSelect" v-model="title" class="form-select form-select-lg">
                                <option disabled>Choose the type of reports</option>
                                <option value="1">Criminal charges, such as embezzlement, breach of trust, blackmail, theft,
                                    bribery, private financing arrangements, unfair acts related to savings, escape of
                                    property, etc.</option>
                                <option value="2">Acts of violation of either law of real name financial transaction or
                                    anti-money laundering laws.</option>
                                <option value="3">An unfair instruction by one's superior</option>
                                <option value="4">Sexual harassment</option>
                                <option value="5">An act that causes loss to the company on purpose or by negligence
                                </option>
                                <option value="6">Other illegal or unjust handling of duties and acts deemed to be signs of
                                    accidents</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-2 themed-grid-col col-form-label" style="color:black">A person subjected to the
                            report (<span style="color: red">*</span>)</div>
                        <div class="col-md-8 themed-grid-col">
                            <div class="row mb-2">
                                <div class="col-md-2 themed-grid-col" style="color:black">Company</div>
                                <div class="col-md-10 themed-grid-col">
                                    <input type="text" v-model="company" class="form-control" id="basic-default-company"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2 themed-grid-col" style="color:black">Department</div>
                                <div class="col-md-10 themed-grid-col">
                                    <input type="text" v-model="department" class="form-control" id="basic-default-company"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2 themed-grid-col" style="color:black">Name</div>
                                <div class="col-md-10 themed-grid-col">
                                    <input type="text" v-model="name" class="form-control" id="basic-default-company"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-datetime-local-input" class="col-md-2 col-form-label" style="color:black">The date
                            and time of the
                            event (<span style="color: red">*</span>)</label>
                            Show: {{ date_time }}
                        <div class="col-md-10">
                            <input class="form-control" v-model="date_time" type="datetime-local"
                                id="html5-datetime-local-input">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-company" style="color:black">Place of
                            occourrence of the
                            event (<span style="color: red">*</span>)</label>
                        <div class="col-sm-10">
                            <input type="text" v-model="place_of_the_event" class="form-control" id="basic-default-company"
                                placeholder="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-message" style="color:black">Details of
                            event (<span style="color: red">*</span>)</label>
                        <div class="col-sm-10">
                            <div class="form-text"> <span style="color: red">*</span>Please describe the incident
                                specifically. </div>
                            <div class="input-group input-group-merge">
                                <textarea id="basic-default-message" v-model="detail_of_event" class="form-control"
                                    style="height: 94px;"></textarea>
                            </div>
                            <div class="form-text"> <span style="color: red">*</span>Please write it down in as much detail
                                as possible.
                                It will be used as important material for the investigation. However,
                                you must not mention any detailed information which can lead your identity to being
                                revealed.
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-company" style="color:black">The attached
                            file (<span style="color: red">*</span>)</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="file" @change="onSelected" class="form-control" id="inputGroupFile02">
                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                <button type="button" class="btn btn-icon btn-outline-primary">
                                    <i class='bx bx-plus'></i>
                                </button>
                                <button type="button" class="btn btn-icon btn-outline-danger">
                                    <i class='bx bx-minus'></i>
                                </button>
                            </div>
                            <div class="form-text"> <span style="color: red">*</span>It is possible to register up to 5
                                files, up to 2MB per file, and up to 10MB in total. (jpg, jpeg, png) </div>
                        </div>
                    </div>
                    <hr style="color: black;">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-company"
                            style="font-size: 18px; font-weight: bold;">
                            <span style="color: red;">*</span>:<u><i>Essential</i></u>
                        </label>
                        <div>
                            <i class='bx bx-radio-circle-marked' style="color: #5780b4; font-size: 24px;"></i> <span
                                style="color: black; font-size: 18px; font-weight: bold;">Additional
                                inquiries</span>
                        </div>
                    </div>
                    <hr style="color: lightskyblue; height: 5px;">
                    <div class="row mb-3 text-info">
                        <div class="col-sm-12">
                            <i class='bx bxs-circle' style="color: #5780b4"></i> <span
                                style="color: black; font-weight: bold;">Please mention anyone who
                                is aware of the incident or is estimated to know this.</span>
                            <input type="text" v-model="mention_anyone" class="form-control" id="basic-default-company"
                                placeholder="">
                        </div>
                    </div>
                    <hr style="color: black;">
                    <div class="row mb-3 text-info">
                        <div class="col-sm-12">
                            <i class='bx bxs-circle' style="color: #5780b4"></i> <span
                                style="color: black; font-weight: bold;">Please feel free to share any
                                ideas which might be the best way to investigate this problem.</span>
                            <input type="text" v-model="feel_free" class="form-control" id="basic-default-company"
                                placeholder="">
                        </div>
                    </div>
                    <hr style="color: black;">
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <i class='bx bxs-circle' style="color: #5780b4"></i> <span
                                style="color: black; font-weight: bold;">How do you know this
                                problem happen?</span>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" v-model="problem_happen" type="radio"
                                    name="inlineRadioOptions" id="inlineRadio1" value="It happened to me">
                                <label class="form-check-label" for="inlineRadio1" style="color:black">It happened to
                                    me</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" v-model="problem_happen" type="radio"
                                    name="inlineRadioOptions" id="inlineRadio1" value="Told by an outsider">
                                <label class="form-check-label" for="inlineRadio1" style="color:black">Told by an
                                    outsider</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" v-model="problem_happen" type="radio"
                                    name="inlineRadioOptions" id="inlineRadio1" value="I’ve seen or heard it by myself">
                                <label class="form-check-label" for="inlineRadio1" style="color:black">I’ve seen or heard it
                                    by myself</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" v-model="problem_happen" type="radio"
                                    name="inlineRadioOptions" id="inlineRadio1" value="I heard it by rumor">
                                <label class="form-check-label" for="inlineRadio1" style="color:black">I heard it by
                                    rumor</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" v-model="problem_happen" type="radio"
                                    name="inlineRadioOptions" id="inlineRadio1" value="I heard it from a co-worker">
                                <label class="form-check-label" for="inlineRadio1" style="color:black">I heard it from a
                                    co-worker</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" v-model="problem_happen" type="radio"
                                    name="inlineRadioOptions" id="inlineRadio1" value="Other">
                                <label class="form-check-label" for="inlineRadio1" style="color:black">Other</label>
                            </div>
                        </div>
                    </div>
                    <hr style="color: black;">
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <i class='bx bxs-circle' style="color: #5780b4"></i> <span
                                style="color: black; font-weight: bold;">How long do you think this
                                problem has lasted?</span>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" v-model="problem_has_lasted" type="radio"
                                    name="inlineRadioOptions" id="inlineRadio1" value="Today">
                                <label class="form-check-label" for="inlineRadio1" style="color:black">Today</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" v-model="problem_has_lasted" type="radio"
                                    name="inlineRadioOptions" id="inlineRadio1" value="Within a week">
                                <label class="form-check-label" for="inlineRadio1" style="color:black">Within a week</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" v-model="problem_has_lasted" type="radio"
                                    name="inlineRadioOptions" id="inlineRadio1" value="Within a week to a month">
                                <label class="form-check-label" for="inlineRadio1" style="color:black">Within a week to a
                                    month</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" v-model="problem_has_lasted" type="radio"
                                    name="inlineRadioOptions" id="inlineRadio1" value=">Within a month to 3 months">
                                <label class="form-check-label" for="inlineRadio1" style="color:black">Within a month to 3
                                    months</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" v-model="problem_has_lasted" type="radio"
                                    name="inlineRadioOptions" id="inlineRadio1" value="Within 3 months to a year">
                                <label class="form-check-label" for="inlineRadio1" style="color:black">Within 3 months to a
                                    year</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" v-model="problem_has_lasted" type="radio"
                                    name="inlineRadioOptions" id="inlineRadio1" value="More than one year">
                                <label class="form-check-label" for="inlineRadio1" style="color:black">More than one
                                    year</label>
                            </div>
                        </div>
                    </div>
                    <hr style="color: black;">
                    <div class="row justify-content-end">
                        <div class="d-grid gap-2 col-lg-2 mx-auto">
                            <button type="submit" class="btn btn-outline-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'DGBWebsiteCompliance',

    data() {
        return {
            recipient: '',
            type_of_report: '',
            title: '',
            company: '',
            department: '',
            name: '',
            date_time: '',
            place_of_the_event: '',
            detail_of_event: '',
            the_attached_file: '',
            mention_anyone: '',
            feel_free: '',
            problem_happen: '',
            problem_has_lasted: '',
        };
    },

    mounted() {

    },

    methods: {

    },
};
</script>

<style scoped></style>